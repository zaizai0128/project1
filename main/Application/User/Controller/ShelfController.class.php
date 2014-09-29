<?php
/**
 * 个人书架controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace User\Controller;

class ShelfController extends UserController {

	/**
	 * 书架首页
	 */
	public function index()
	{
		
		$this->display();
	}
}