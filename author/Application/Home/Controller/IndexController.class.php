<?php
/**
 * 作者站首页
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;

class IndexController extends BaseController {

	/**
	 * 作者站首页
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 作者必读
	 */
	public function read()
	{
		$info = file_get_contents('http://www.zhulang.com/w_author_privilige_info.php');
		$this->show($info);
	}

}