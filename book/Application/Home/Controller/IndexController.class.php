<?php
/**
 * 普通作品的父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class IndexController extends HomeController {

	private $_book_api = Null;
	private $_book_info = Null;

	public function __construct()
	{
		parent::__construct();

		$this->_book_api = new Zapi\Book($this->book_id);
		$this->_book_info = $this->_book_api->getBookInfo();
	}

	/**
	 * 作品的目录页
	 */
	public function index()
	{
		// 获取作品分类
		$book_cate = Zapi\BookClass::getInstance()->getPathArray($this->_book_info['bk_class_id']);
		
		$this->assign(array(
			'book_cate' => $book_cate,
			'book_info' => $this->_book_info,
		));
		$this->display();
	}

	/**
	 * 章节品读页
	 */
	public function read()
	{


	}
}