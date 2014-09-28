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

	public function __construct()
	{
		parent::__construct();

		// 权限验证机制
		\Zlib\Api\Acl::user();
		
		$this->userId = ZS('SESSION.user', 'user_id');
	}
}