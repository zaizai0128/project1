<?php
/**
 * 作品封面页
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class BookController extends HomeController {

	private $_book_api = Null;
	private $_book_id = Null;
	private $_book_info = Null;

	public function __construct()
	{
		parent::__construct();
		$this->_book_id = I('get.book_id');
		$this->checkBookAcl($this->_book_id);
		$this->_book_api = new Zapi\Book($this->_book_id);
		$this->_book_info = $this->_book_api->getBookInfo();
	}

	/**
	 * 封面首页
	 */
	public function index()
	{
		// 获取作品分类
		$book_cate = Zapi\BookClass::getInstance()->getPathArray($this->_book_info['bk_class_id']);
		// 获取点击排名
		// $book_rank = 

		// 其他一些赋值
		$assign = array();

		// 作品类型，主分类
		$tmp = $book_cate;
		$tmp = array_shift($tmp);
		$assign['category'] = $tmp['name'];

		$this->assign(array(
			'assign' => $assign,
			'book_info' => $this->_book_info,
			'book_cate' => $book_cate,
		));
		$this->display();
	}
	
}