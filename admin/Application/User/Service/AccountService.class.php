<?php
/**
 * 用户账户 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-11
 * @version 1.0
 */
namespace User\Service;
use \Zlib\Model\ZlibAccountsModel;
use \Zlib\Api\Account;

class AccountService extends ZlibAccountsModel {

	/**
	 * 修改账户金融信息
	 * 
	 */
	public function changeAccount($data)
	{
		$user_id = $data['user_id'];
		$type = $data['type'];
		$sub_type = $data['subtype'];
		$memo = $data['memo'];
		$amount = $data['amount'];
		$bonus = $data['bonus'];
		$expire = $data['expire'];
		$ip = z_ip();

		// 先获取金融信息
		$info = $this->getAccountByUserId($user_id);

		// 如果无期限
		if ($info['bonus_expire'] != '9999-99-99') {
			$expire = date('Y-m-d', strtotime($expire.' day', strtotime($info['bonus_expire'])));
		} else {
			$expire = '9999-99-99';
		}
		
		// 创建对象
		$account = new Account($user_id, $type, $memo, $ip, $sub_type); 
		$order_id = z_order_id();

		// 判断添加的金融信息
		if (empty($amount) && empty($bonus)) {
			return z_ajax_info(-1, '请选择金额');

		// 增加2种
		} else if (!empty($amount) && !empty($bonus)) {
			$state = $account->increBoth($amount, $bonus, $order_id, $expire);

		// 增加逐浪币
		} else if (!empty($amount)) {
			$state = $account->incre($amount, $order_id);

		// 增加逐浪奖金币
		} else if (!empty($bonus)) {
			$state = $account->increBonus($bonus, $order_id, $expire);
		}

		return $state ? z_ajax_info(1, '调整成功'): z_ajax_info(0, '调整失败') ;
	}

	/**
	 * 修改失效时间
	 */
	public function changeExpire($data)
	{
		$info = $this->getAccountByUserId($data['user_id']);

		// 如果无期限
		if ($info['bonus_expire'] != '9999-99-99') {
			$expire = date('Y-m-d', strtotime($data['expire'].' day', strtotime($info['bonus_expire'])));
		} else {
			$expire = '9999-99-99';
		}

		// 记录日志 类型，子类型，调整天数，调整后的日期
		$log = 'type:['.$data['type'].'] subtype:['.$data['subtype'].'] day:['.$data['expire'].'] expire:['.$expire.']';
		z_log($log, 'LOG_CHANGE');

		$rs = $this->changeBonusExpire($data['user_id'], $expire);
		return $rs ? z_ajax_info(1, '修改成功') : z_ajax_info(0, '修改失败') ;
	}

	/**
	 * 清空金额
	 */
	public function clearAccount($data)
	{
		$user_id = $data['user_id'];
		$type = $data['type'];
		$sub_type = $data['subtype'];
		$memo = $data['memo'];
		$ip = z_ip();

		// 创建对象
		$account = new Account($user_id, $type, $memo, $ip, $sub_type); 
		$rs = $account->clear();
		return $rs ? z_ajax_info(1, '清空成功') : z_ajax_info(0, '清空失败，请重新尝试');
	}

}