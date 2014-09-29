<?php
/**
 * 购买的基类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Buy\Controller;
use Think\Controller;

class BuyController extends Controller {

	protected $bookId = Null;
	protected $chapterId = Null;
	protected $chapterInfo = Null;
	protected $bookInfo = Null;
	protected $bookInstance = Null;
	protected $chapterInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->chapterId = I('get.ch_id');
		$this->chapterInstance = D('Chapter', 'Service')->getInstance($this->bookId,$this->chapterId);
		$this->chapterInfo = $this->chapterInstance->getChapterCommodity();
		$bookApi = new \Zlib\Api\Book($this->bookId);
		$this->bookInfo = $bookApi->getInfo();
		\Zlib\Api\Acl::buy($this->chapterInfo);
	}

}