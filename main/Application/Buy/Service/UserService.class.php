<?php
/**
 * 用户 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-25
 * @version 1.0
 */
namespace Buy\Service;
use Zlib\Model\ZlibUserModel;
use Zlib\Model\ZlibAccountsModel;

class UserService extends ZlibUserModel {

	protected $accountInstance = Null;

	public function init()
	{
		parent::init();
		$this->accountInstance = new ZlibAccountsModel;
	}
	
	/**
	 * 获取用户信息，包含账户余额
	 * @param int user_id
	 */
	public function getAccountInfo($user_id)
	{
		$user_info = parent::getUserInfoByUserId($user_id);
		$account_info = $this->accountInstance->getAccountByUserId($user_id);
		
		return array_merge($user_info, (array)$account_info);
	}

}