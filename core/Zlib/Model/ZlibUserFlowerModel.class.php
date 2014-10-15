<?php
/**
 * 用户鲜花 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibUserFlowerModel extends BaseModel {

	const TYPE = 'F001';
	protected $trueTableName = 'zl_user_flower';
	protected $addLogInstance = Null;
	protected $sendLogInstance = Null;

	protected $nowTime = Null;

	protected function init()
	{
		parent::init();
		$this->addLogInstance = M('zl_flower_addlog');
		$this->sendLogInstance = M('zl_flower_sendlog');
		$this->nowTime = date('Ym');
	}

	/**
	 * 设置年月
	 * @param String Ym
	 */
	public function setNowTime($now)
	{
		$this->nowTime = $now;
	}

	public function getNowTime()
	{
		return $this->nowTime;
	}

	/**
	 * 添加消费赠送鲜花日志
	 */
	public function addCostAddFlowerLog($data)
	{
		return $this->addLogInstance->data($data)->add();
	}

	/**
	 * 添加鲜花
	 */
	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 修改
	 */
	public function doEdit($data)
	{
		$condition = 'id = '.$data['id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 获取当月用户的鲜花信息
	 * @param int user_id
	 * @param String field 
	 */
	public function getFlower($user_id, $field='*')
	{
		$condition = 'user_id = '.$user_id.' and month = "'.$this->nowTime.'" and type = "'.self::TYPE.'"';
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 获取用户鲜花总数
	 * @param int user_id
	 */
	public function getFlowerSum($user_id)
	{
		$condition = 'user_id = '.$user_id.' and month = "'.$this->nowTime.'" and type = "'.self::TYPE.'"';
		$r = $this->field('total_num')->where($condition)->find();
		return (int)$r['total_num'];
	}

	/**
	 * 获取应该增加的鲜花数
	 *
	 * @param int 获取当月消费总额
	 * @param int 获取当月用户的鲜花总数
	 */
	public function getAddFlowerNum($cost_total, $flower_total)
	{
		return floor(($cost_total - $flower_total * C('APP.cost_num_give_flower')) / C('APP.cost_num_give_flower'));
	}

	/**
	 * 获取 距离下一次获取鲜花，需要消费多少
	 * @param int 获取当月消费总额
	 */
	public function getNextFlowerNum($user_id, $cost_total)
	{
		$total = $this->getFlowerSum($user_id);

		// 获取剩余数
		$cha = (int)($cost_total - $total * C('APP.cost_num_give_flower'));
		return (int)(C('APP.cost_num_give_flower') - $cha);
	}

}