<?php
/**
 * 用户 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace App\Service;
use Zlib\Model\ZlibUserModel;
use Zlib\Model\ZlibAccountsModel;

class UserService extends ZlibUserModel {

	protected $accountInstance = Null;
	protected $userAuthorInstance = Null;

	public function init()
	{
		parent::init();
		$this->accountInstance = new ZlibAccountsModel;
		$this->userAuthorInstance = D('UserAuthor', 'Service');
	}

	/**
	 * 获取个人信息和账户余额
	 * @param int user_id
	 */
	public function getUserInfo($user_id)
	{
		$user_info = $this->getUserFullInfoByUserId($user_id);
		$user_info['user_like_tag'] = unserialize($user_info['user_like_tag']);
		$account = $this->accountInstance->getAccountByUserId($user_id);
		return array_merge($user_info, (array)$account);
	}
}