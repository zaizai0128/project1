<?php
/**
 * 书站的父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller {

	protected $bookId = Null;
	protected $chapterId = Null;
	protected $bookInfo = Null;
	protected $bookClassApi = Null;
	protected $bookInstance = Null;


	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->chapterId = I('get.ch_id');
		$this->bookInstance = D('Book', 'Service');
		$this->bookInfo = $this->bookInstance->getBookByBookId($this->bookId);
		\Zlib\Api\Acl::book($this->bookInfo);
		$this->bookClassApi = \Zlib\Api\BookClass::getInstance();
	}
}