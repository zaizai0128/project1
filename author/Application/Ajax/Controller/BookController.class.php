<?php
/**
 * 作品 ajax
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-08
 * @version 1.0
 */
namespace Ajax\Controller;

class BookController extends AjaxController {

	/**
	 * 判断作品名称是否存在
	 */
	public function bookNameExists()
	{
		$book_name = I('post.name');
		$bookInstance = D('Book', 'Service');
		$state = $bookInstance->bookNameExists($book_name);
		$this->ajaxReturn($state);
	}



}