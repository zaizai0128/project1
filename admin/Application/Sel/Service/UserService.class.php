<?php
/**
 * 用户查询 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-31
 * @version 1.0
 */
namespace Sel\Service;
use Zlib\Model\ZlibUserModel;
use Zlib\Model\ZlibAccountsModel;
use Zlib\Model\ZlibUserFlowerModel;
use Zlib\Model\ZlibBillModel;

class UserService extends ZlibUserModel {

	protected $accountInstance = Null;
	protected $flowerInstance = Null;
	protected $billInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->accountInstance = new ZlibAccountsModel;
		$this->flowerInstance = new ZlibUserFlowerModel;
		$this->billInstance = new ZlibBillModel;
	}
	
	/**
	 * 获取用户展现信息
	 */
	public function getInfo($user_id)
	{
		$user_info = $this->getUserFullInfoByUserId($user_id);
		$user_info['user_like_tag'] = json_decode($user_info['user_like_tag'], True);
		$user_info['account'] = $this->accountInstance->getAccountByUserId($user_id);
		$user_info['flower'] = $this->flowerInstance->getFlower($user_id);
		$user_info['add_log'] = $this->flowerInstance->getAddLog($user_id);
		$user_info['send_log'] = $this->flowerInstance->getSendLog($user_id);
		$user_info['bill'] = $this->billInstance->getBillList($user_id);

		return $user_info;
	}
	


}