<?php
/**
 * 账号管理controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace User\Controller;

class AccountController extends UserController {

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function init()
	{
		$this->userInfo = $this->userInstance->getUserInfo($this->userId);

		$this->assign(array(
			'user_info' => $this->userInfo,
		));
	}

	/**
	 * 个人信息
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 补充用户信息
	 */
	public function doEditInfo()
	{
		if (IS_POST) {
			$data = array_merge(I(), array('user_id'=>$this->userId));
			$state = $this->userInstance->doEditInfo($data);

			if ($state['code'] > 0)
				z_redirect($state['msg'], ZU('user/center/index')); 
			else
				z_redirect($state['msg']);
		}
	}

	/**
	 * 自定义头像
	 */
	public function avatar()
	{

		$this->display();
	}

	/**
	 * 系统头像
	 */
	public function pic()
	{

		$this->display();
	}

	/**
	 * 修改密码
	 */
	public function password()
	{

		$this->display();
	}

	public function doPassword()
	{
		if (IS_POST) {
			$data = array_merge(I(), $this->userInfo);
			$state = $this->userInstance->doEditPwd($data);

			if ($state['code'] > 0)
				z_redirect($state['msg'], ZU('user/center/index')); 
			else
				z_redirect($state['msg']);
		}
	}
}