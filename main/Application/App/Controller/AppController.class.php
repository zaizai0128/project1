<?php
/**
 * 应用分组的父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-29
 * @version 1.0
 */
namespace App\Controller;
use Think\Controller;

class AppController extends Controller {

	protected $userId = Null;
	protected $userInfo = Null;
	protected $userInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userId = ZS('SESSION.user', 'user_id');
		$this->userInstance = D('User', 'Service');
		$this->userInfo = $this->userInstance->getUserInfo($this->userId);
		
		\Zlib\Api\Acl::app($this->userInfo);
	}

}