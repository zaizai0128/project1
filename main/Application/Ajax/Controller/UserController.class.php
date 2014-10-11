<?php
/**
 * 用户 ajax
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Ajax\Controller;

class UserController extends AjaxController {

	protected $userInctance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userInctance = D('User', 'Service');
	}

	/**
	 * 判断用户名是否可用
	 *
	 * @param String username
	 */
	public function checkUsername($username)
	{
		$state = $this->userInctance->checkUsername($username);
		$this->ajaxReturn($state);
	}

	/**
	 * 判断邮箱是否可用注册
	 */
	public function checkEmail($email)
	{
		$state = $this->userInctance->checkEmail($email);
		$this->ajaxReturn($state);
	}

}