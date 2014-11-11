<?php
/**
 * 账户金融 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-25
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibAccountsModel extends BaseModel {

	protected $trueTableName = 'zl_accounts';

	/**
	 * 获取用户的账户余额
	 *
	 * @param int user_id
	 * @param field
	 */
	public function getAccountByUserId($user_id, $field = 'amount,bonus,bonus_expire')
	{
		return $this->field($field)->where('oid = '.$user_id)->find();
	}

	/**
	 * 减去用户的金币
	 */
	public function reduceAccount($data)
	{
		$condition = 'oid = '.$data['user_id'];
		return $this->where($condition)->setDec('amount', $data['num']);
	}

	/**
	 * 调整用户奖金币的时效
	 */
	public function changeBonusExpire($user_id, $expire)
	{
		$condition['oid'] = $user_id;
		$data['bonus_expire'] = $expire;
		return $this->where($condition)->data($data)->save();
	}

}