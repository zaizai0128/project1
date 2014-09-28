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
	public function doAddExt()
	{
		if (IS_POST) {
			$data = array_merge($this->userInfo, I());

			de($data);
			$state = $this->userInstance->doEditExt($data);

			if ($state['code'] > 0)
				z_redirect($state['msg'], ZU('user/center/index')); 
			else
				z_redirect($state['msg']);
		}
	}

	/**
	 * 更新真实信息
	 */
	public function trueInfo()
	{
		$author_info = D('UserAuthor', 'Service')->getAuthorInfoByUserId($this->userId);

		$this->assign(array(
			'author_info' => $author_info
		));
		$this->display();
	}

	/**
	 * 补充真实信息
	 */
	public function doTrueInfo()
	{
		if (IS_POST) {
			$data = array_merge($this->userInfo, I());
			
			$state = D('UserAuthor', 'Service')->doEdit($data);

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
}