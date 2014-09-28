<?php
/**
 * 用户基类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */
namespace User\Controller;
use Think\Controller;

class UserController extends Controller {

	protected $userId = Null;
	protected $userInfo = Null;
	protected $userInstance = Null;

	public function __construct()
	{
		parent::__construct();

		// 权限验证机制
		\Zlib\Api\Acl::user();
		$this->userInstance = D('User', 'Service');
		$this->userId = ZS('SESSION.user', 'user_id');
		// 获取基础用户信息
		$htis->userInfo = $this->userInstance->getUserInfoByUserId($this->userId);
	}
}