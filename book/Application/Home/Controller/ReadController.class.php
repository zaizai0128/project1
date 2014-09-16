<?php
/**
 * 章节阅读controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class ReadController extends HomeController {

	private $_chapter_info = Null;

	public function __construct()
	{
		parent::__construct();
		$this->checkChapterAcl();
		$this->_chapter_info = $this->chapter_api->getChapterInfo();
	}

	/**
	 * 普通作品的章节页
	 */
	public function index()
	{

		$this->assign(array(
			'book_info' => $this->book_info,
			'chapter_info' => $this->_chapter_info,
		));
		$this->display();
	}

	/**
	 * vip章节页
	 */
	public function vip()
	{
		// 验证vip章节
		$this->checkChapterVipAcl();

		// 获取vip章节内容
		$vip_chapter_info = $this->chapter_api->getVipChapterInfo();

		dump($vip_chapter_info);


		$this->assign(array(
			'book_info' => $this->book_info,
			'chapter_info' => $this->_chapter_info,
		));
		$this->display();
	}
}