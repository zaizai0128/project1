<?php
/**
 * 后台管理站 父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Common\Controller;
use Think\Controller;
use Zlib\Api as Zapi;

class BaseController extends Controller {

	protected $user_id;

	public function __construct()
	{
		parent::__construct();

		// 未登录提示
		if (!session('user')) {
			$this->error('请登录', ZU('/login/index'));
		}
		
		// 用户状态非作者提示
		if (!in_array(session('user.user_type'), array('04')) ) {
			$this->error('抱歉，您不是管理员');
		}

		$this->init();
	}

	protected function init()
	{
		$this->user_id = session('user.user_id');
	}
}