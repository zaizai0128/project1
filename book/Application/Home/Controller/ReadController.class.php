<?php
/**
 * 章节阅读controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;

class ReadController extends HomeController {

	protected $chapterInstance = Null; // 普通章节
	protected $chapterVipInstance = Null; // vip章节
	protected $chapterInfo = Null;
	protected $isVip = False; 		// 判断章节是否是vip
	protected $isBuy = False;		// 判断是否已经购买

	public function __construct()
	{
		parent::__construct();
		$this->chapterInstance = D('Chapter', 'Service')->getInstance($this->bookId, $this->chapterId);
		$this->chapterInfo = $this->chapterInstance->getChapterInfo();
		$this->isVip = $this->chapterInfo['ch_vip'];
		\Zlib\Api\Acl::chapter($this->chapterInfo);
		$this->chapterVipInstance = D('ChapterVip', 'Service')->getInstance($this->bookId, $this->chapterId);
	}

	/**
	 * 普通作品的章节页
	 */
	public function index()
	{	
		// vip章节
		if ($this->isVip == 1)
			$this->chapterInfo['ch_content'] = $this->chapterVipInstance->getChapterContent();
		else
			$this->chapterInfo['ch_content'] = $this->chapterInstance->getChapterContent();

		// 获取相邻章节
		$sibling_chapter = $this->chapterInstance->getSiblingChapter($this->chapterInfo['ch_roll']);

		$this->assign(array(
			'book_info' => $this->bookInfo,
			'chapter_info' => $this->chapterInfo,
			'sibling_chapter' => $sibling_chapter,
		));
		$this->display();
	}

}