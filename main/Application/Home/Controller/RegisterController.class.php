<?php
/**
 * 注册 	
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Home\Controller;

class RegisterController extends HomeController {

	protected $userInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = D('User', 'Service');
	}

	/**
	 * 注册页面 主 个性化注册
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 执行个性化注册
	 */
	public function doRegister()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->userInstance->doAdd($data);

			if ($state['code'] > 0) {
				z_redirect('注册成功', ZU('login/index'));
			} else {
				z_redirect($state['msg']);
			}
		}
	}


	/**
	 * 手机注册
	 */
	public function phone()
	{

		$this->display();
	}

	/**
	 * 邮箱注册
	 */
	public function email()
	{


		$this->display();
	}

	// 验证码
	public function verify()
	{
		$Verify = new \Think\Verify();
		$Verify->entry();
	}
}