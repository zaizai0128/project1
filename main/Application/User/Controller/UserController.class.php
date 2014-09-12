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

	protected $user_id;

	public function __construct()
	{
		parent::__construct();

		if (!session('user')) {
			$this->error('请登录', U('/login/index'));
		}

		$this->user_id = session('user.user_id');
	}
}