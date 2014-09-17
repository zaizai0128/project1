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

	protected $book_id = Null;	
	protected $ch_id = Null;
	protected $book_api = Null;
	protected $book_class_api = Null;
	protected $book_info = Null;
	protected $chapter_api = Null;
	protected $is_buy = False;	// 判断用户是否已经购买

	public function __construct()
	{
		parent::__construct();
		$this->book_id = I('get.book_id');
		$this->ch_id = I('get.ch_id');
		$this->init();
	}

	public function init()
	{
		$this->checkBookAcl();
		$this->book_class_api = Zapi\BookClass::getInstance();
	}

	/**
	 * 验证 作品
	 */
	public function checkBookAcl()
	{
		if (empty($this->book_id))
			$this->error('作品不存在');
		$this->book_api = new Zapi\Book($this->book_id);

		if (!$this->book_api->checkBook())
			$this->error('作品不存在');

		// 获取作品信息
		$this->book_info = $this->book_api->getBookInfo();

		// 判断作品状态
		if ($this->book_info['bk_status'] == '01')
			$this->error('该作品已被关闭');

		if ($this->book_info['bk_status'] == '02' || $this->book_info['bk_status'] == '03')
			$this->error('该作品未经管理员审核');

		return True;
	}

	/**
	 * 验证章节
	 */
	public function checkChapterAcl()
	{
		if (empty($this->ch_id)) 
			$this->error('章节不存在');

		// 创建chapter_api对象
		$this->chapter_api = new Zapi\Chapter($this->book_id, $this->ch_id);

		if (!$this->chapter_api->checkChapter())
			$this->error('章节不存在');

		$this->chapter_info = $this->chapter_api->getChapterInfo();

		if ($this->chapter_info['ch_status'] == 1)
			$this->error('章节已被删除');

		return True;
	}

	/**
	 * 验证vip章节信息
	 */
	public function checkVipChapterAcl()
	{
		// 验证用户是否登录
		if (!session('?user')) {
			$this->error('请先登录', ZU('login/index'));
		}

		// 验证用户是否拥有看此vip章节的权限

		// 验证该vip书籍 是否处于正常发布状态
		if ($this->chapter_info['ch_lock'] == 1) {
			$this->error('该章节正处于修正中');
		}

		if ($this->chapter_info['ch_status'] != 0) {
			$this->error('该章节非对外开放');
		}

		if ($this->chapter_info['ch_vip'] != 1) {
			$this->error('该章节非vip');
		}

		return True;
	}
}