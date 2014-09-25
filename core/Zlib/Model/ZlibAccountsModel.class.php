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

}