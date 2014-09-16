<?php
/**
 * vip作品的父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;

class VipController extends HomeController {

	/**
	 * 作品的目录页
	 */
	public function index()
	{
		de($this->_book_id);
		
		$this->display();
	}

	/**
	 * 章节品读页
	 */
	public function read()
	{

	}
}