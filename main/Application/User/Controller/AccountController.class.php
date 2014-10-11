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
				z_redirect($state['msg'], '', 1, -1);
		}
	}

	/**
	 * 注册成功后的补充资料
	 */
	public function doFullInfo()
	{
		if (IS_POST) {
			$data = array_merge(I(), array('user_id'=>$this->userId));
			$state = $this->userInstance->doFullInfo($data);

			if ($state['code'] > 0)
				z_redirect($state['msg'], ZU('user/center/index'));
			else
				z_redirect($state['msg'], '', 1, -1);
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

	/**
	 * 执行修改密码
	 */
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