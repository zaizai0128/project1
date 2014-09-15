<?php
/**
 * 后台管理站首页
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;

class IndexController extends BaseController {

	/**
	 * 后台首页
	 */
	public function index()
	{
		$this->display();
	}

}