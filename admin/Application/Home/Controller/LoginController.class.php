<?php
/**
 * 后台登陆
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-20
 * @version 1.0
 */

namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller {

	protected $adminInstance = Null;

	public function __construct()
	{
		parent::__construct();

		$this->adminInstance = D('Admin', 'Service');
	}

	/**
	 * 登陆界面
	 */
	public function index()
	{

		$this->display();
	}

	/**
	 * 执行登录
	 */
	public function login()
	{
		if (IS_POST) {
			$data['user_name'] = I('post.name');
			$data['password'] = I('post.pwd');
			$data['verify'] = I('post.verify');
			$state = $this->adminInstance->login($data);
			$this->ajaxReturn($state);
		}
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		$state = $this->adminInstance->logout($data);
		z_redirect('退出成功', ZU('login/index', 'ZL_ADMIN_DOMAIN'));
	}

	// 验证码
	public function verify()
	{
		$Verify = new \Think\Verify();
		$Verify->entry();
	}

}
