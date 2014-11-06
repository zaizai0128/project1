<?php
/**
 * 账户充值接口类
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-06
 * @version 1.0
 */
namespace Zlib\Api;
use Think\Model;

class Account {

	protected $userId = null;	// 用户id
	protected $type = null;		// 充值方式
	protected $subType = null;		// 充值方式 子方式
	protected $order_id = null;	// 订单号
	protected $result = null;	// 记录每一步操作的结果
	protected $err_result = null; // 记录每一步的错误
	protected $now = null;			// 当前时间
	protected $record = null;

	protected $db = null;		
	protected $accountInstance = null;

	/**
	 * 初始化
	 * @param int 用户id
	 * @param int 充值方式
	 * @param int 充值子方式
	 * @param string order_id
	 */
	public function __construct($user_id, $type, $sub_type = 0, $order_id = null)
	{
		$this->userId = $user_id;
		$this->type = $type;
		$this->subType = $sub_type;
		$this->order_id = isset($order_id) ? $order_id : date('YmdHis', time()) . mt_rand(100000, 999999) ;

		$this->result = array();
		$this->err_result = array();
		$this->record = array();
		$this->now = z_now();

		$this->db = new Model;
		$this->accountInstance = M('zl_accounts');
	}

	/**
	 * 充值逐浪币
	 * 
	 * @param int 逐浪币
	 * @return boolean
	 */
	public function incre($money)
	{
		$this->db->startTrans();	// 开启事务

		$this->result['account'] = $this->accountInstance->where('oid='.$this->userId)
								->setInc('amount', $money);
		$this->err_result['account_err'] = $this->accountInstance->getDbError();
			
		$record['amount'] = $money;

		// 添加到充值日志表中。
		$this->_recharge($record);

		// 提交
		return $this->_commit();
	}

	/**
	 * 充值逐浪奖金币
	 * 
	 * @param int 逐浪奖金币
	 * @param int 时效时间
	 */
	public function increBonus($money, $expire = null)
	{
		$this->db->startTrans();	// 开启事务
		$expire = isset($expire) ? $expire : date('Y-m-t', time());

		$bonus['bonus'] = array('exp', 'bonus+'.$money);
		$bonus['bonus_expire'] = $expire;
		$this->result['account'] = $this->accountInstance->where('oid='.$this->userId)->data($bonus)->save();

		$record['bonus'] = $money;
		$record['memo'] = $expire;

		$this->_recharge($record);
		return $this->_commit();
	}

	/**
	 * 清除某用户的逐浪奖金币
	 */
	public function clearBonus()
	{
		$this->db->startTrans();	// 开启事务
		$account = $this->accountInstance->field('oid,bonus,bonus_expire')->where('oid='.$this->userId)->find();

		$bonus['bonus'] = array('exp', 'bonus+'.-$account['bonus']);
		$bonus['bonus_expire'] = $account['bonus_expire'];
		$this->result['account'] = $this->accountInstance->where('oid='.$this->userId)->data($bonus)->save();

		$record['bonus'] = -$account['bonus'];
		$record['memo'] = $account['bonus_expire'];

		$this->_recharge($record);
		return $this->_commit();
	}

	/**
	 * 清除某用户的全部金币
	 */
	public function clear()
	{
		$this->db->startTrans();	// 开启事务
		$account = $this->accountInstance->field('oid,amount,bonus,bonus_expire')->where('oid='.$this->userId)->find();
		
		$bonus['amount'] = array('exp', 'amount+'.-$account['amount']);
		$bonus['bonus'] = array('exp', 'bonus+'.-$account['bonus']);
		$bonus['bonus_expire'] = $account['bonus_expire'];
		$this->result['account'] = $this->accountInstance->where('oid='.$this->userId)->data($bonus)->save();

		$record['amount'] = -$account['amount'];
		$record['bonus'] = -$account['bonus'];
		$record['memo'] = $account['bonus_expire'];

		$this->_recharge($record);
		return $this->_commit();
	}

	/**
	 * 添加到充值记录中
	 * @param array $record
	 */
	private function _recharge($record)
	{
		$record_instance = M('zl_charge_record');
		$record['user_id'] = $this->userId;
		$record['order_id'] = isset($this->order_id) ? $this->order_id : $record['order_id'];
		$record['oid'] = $this->userId;
		$record['charge_date'] = $this->now;
		$record['charge_type'] = $this->type;
		$record['charge_subtype'] = $this->subType;
		$record['admin_id'] = 0;
		$record['ip'] = z_ip();
		$this->record = $record;
		$this->result['charge_record'] = $record_instance->data($record)->add();

		// 添加充值日志的错误
		$this->err_result['record_err'] = $record_instance->getDbError();
	}

	/**
	 * 添加错误日志
	 */
	private function _fail()
	{
		$record_fail_instance = M('zl_charge_record_fail');
		$err = '';
		foreach($this->err_result as $key=>$val) {
			$err .= $key.':'.$val.'|';
		}
		$this->record['fail'] = '错误原因：'.$err;
		$record_fail_instance->data($this->record)->add();
	}

	/**
	 * 提交操作
	 */
	private function _commit()
	{
		// 如果成功，提交
		if (array_product($this->result)) {
			$this->db->commit();
			return true;
		// 错误日志记录
		} else {
			$this->db->rollback();
			// 记录到 fail表
			$this->_fail();
			return false;
		}
	}
}