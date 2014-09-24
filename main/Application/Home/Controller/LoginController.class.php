<?php
/**
 * 登录
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */
namespace Home\Controller;

class LoginController extends HomeController {

	protected $userInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = D('User', 'Service');
	}

	/**
	 * 登录界面
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 验证登录
	 */
	public function doLogin()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->userInstance->doLogin($data);

			// 登录成功，跳转到用户中心
			if ($state['code'] > 0) {
				z_redirect('登录成功', ZU('user/center/index'));
			} else {
				z_redirect($state['msg']);
			}
		}
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		$this->userInstance->logout();
		z_redirect('退出成功', ZU('index/index'));
	}
}