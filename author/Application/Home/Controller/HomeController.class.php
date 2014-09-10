<?php
/**
 * controller 基类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller {

	public function __construct()
	{
		parent::__construct();
		
		if (!session('user')) {
			$this->error('请登录', ZU('/login/index'));
		}

		if (!in_array(session('user.user_type'), array('02', '03')) ) {
			$this->error('请先申请成为作者，才能继续进行操作', ZU('user/center/apply'));
		}
		
	}
}