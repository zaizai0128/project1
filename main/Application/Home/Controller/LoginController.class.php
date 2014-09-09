<?php
/**
 * 登录 & 注册应用
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class LoginController extends HomeController {

	protected $_user;

	public function __construct()
	{
		parent::__construct();
		$this->_user = new Zapi\User;
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

			$username = I('username');
			$password = I('password');
			$state = $this->_user->login($username, $password);

			if ($state['code'] < 0) {
				$this->error($state['msg']);
			}

			$this->success('登录成功', U('user/center/index'));
		}
	}

	/**
	 * 注册界面
	 */
	public function register()
	{

		$this->display();
	}

	/**
	 * 执行注册
	 */
	public function doRegister()
	{
		if (IS_POST) {

			$username = I('username');
			$password = I('password');
			$re_password = I('repassword');

			// 检测用户名是否可用
			$state = $this->_user->checkUsername($username);

			if ($state['code'] < 0) {
				$this->error($state['msg']);
			}

			// 检测密码
			// 重复密码临时使用password
			$state = $this->_user->checkPassword($password, $re_password);

			if ($state['code'] < 0) {
				$this->error($state['msg']);
			}

			// 执行注册
			$uid = $this->_user->register($username, $password);

			if ($uid > 0) {
				$this->success('注册成功', U('/index/index'));
			} else {
				$this->error('注册失败');
			}
		}
	}
}