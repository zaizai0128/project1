<?php
/**
 * 作品的父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Think\Controller;
use Zlib\Api as Zapi;

class HomeController extends Controller {

	protected $book_id;
	protected $ch_id;
	protected $book_api;
	protected $book_class_api;
	protected $book_info;
	protected $chapter_api;

	public function __construct()
	{
		parent::__construct();

		$this->book_id = I('get.book_id');
		$this->ch_id = I('get.ch_id');
		$this->book_api = new Zapi\Book($this->book_id);
		$this->book_class_api = Zapi\BookClass::getInstance();

		$this->init();
	}

	public function init()
	{
		$this->book_info = $this->book_api->getBookInfo();
	}

	/**
	 * 验证 作品
	 * @param int 		book_id
	 * @param boolean 	是否是vip
	 */
	public function checkBookAcl($book_id, $is_vip = False)
	{
		if (empty($book_id))
			$this->error('作品不存在');

		if (!$this->book_api->checkBook())
			$this->error('作品不存在');

		return True;
	}

	/**
	 * 验证章节
	 *
	 * @param int ch_id
	 */
	public function checkChapterAcl($ch_id, $book_id, $is_vip = False)
	{
		if (empty($ch_id)) 
			$this->error('章节不存在');

		// 创建chapter_api对象
		$this->chapter_api = new Zapi\Chapter($this->book_id, $this->ch_id);

		if (!$this->chapter_api->checkChapter())
			$this->error('章节不存在');

		return True;
	}
}