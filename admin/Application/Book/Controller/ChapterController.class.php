<?php
/**
 * 章节管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Book\Controller;
use Common\Controller\BaseController;

class ChapterController extends BaseController {
	
	protected $bookId = Null;
	protected $bookInfo = Null;
	protected $chapterId = Null;
	protected $bookInstance = Null;
	protected $chapterInstance = Null;

	public function __construct()
	{
		parent::__construct();

		$this->bookId = I('get.book_id');
		$this->chapterId = I('get.ch_id');
		$this->bookInstance = D('Book', 'Service');
		$this->chapterInstance = D('Chapter', 'Service')->getInstance($this->bookId, $this->chapterId);
		$this->bookInfo = $this->bookInstance->getBookByBookId($this->bookId);

		$this->assign('book_info', $this->bookInfo);
	}

	/**
	 * 章节列表
	 */
	public function index()
	{
		$param['ch_vip'] = I('get.vip');
		$param['ch_lock'] = I('get.ch_lock');
		$param['ch_status'] = I('get.ch_status');
		$param['ch_name'] = array('like', '%'.I('get.ch_name').'%');
		$param = z_array_filter($param, False);

		$total = $this->chapterInstance->getChaptersTotal($param);
		$Page = new \Think\Page($total, C('ADMIN.list_size'));
		$have_page['firstRow'] = $Page->firstRow;
		$have_page['listRows'] = $Page->listRows;
		$chapter_list = $this->chapterInstance->getChapters($param, '*', $have_page);

		$param['ch_name'] = I('get.ch_name');
		$this->assign(array(
			'param' => $param,
			'list' => $chapter_list,
			'page' => $Page->show(),
		));
		$this->display();
	}

	public function edit()
	{
		$chapter_info = $this->chapterInstance->getInfo();
		
		// dump($chapter_info);
		$this->assign('chapter_info', $chapter_info);
		$this->display();
	}

}