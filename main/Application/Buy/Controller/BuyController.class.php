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
use Zlib\Api as Zapi;

class BuyController extends Controller {

	protected $book_id;
	protected $chapter_id;
	protected $book_info;
	protected $chapter_info;
	protected $book_obj;
	protected $chapter_obj;

	public function __construct()
	{
		parent::__construct();
		$this->book_id = I('get.book_id');
		$this->chapter_id = I('get.ch_id');
		$this->book_obj = new Zapi\Book($this->book_id);
		$this->chapter_obj = new Zapi\Chapter($this->book_id, $this->chapter_id);

		// 初始化操作
		$this->init();
	}

	protected function init()
	{
		$this->checkAcl();

	}

	// 基本验证
	protected function checkAcl()
	{
		if (empty($this->book_id))
			$this->error('作品序号不允许为空'); 
		if (empty($this->chapter_id)) 
			$this->error('章节序号不允许为空'); 
		if(!$this->chapter_obj->checkChapter()) 
			$this->error('章节不存在');

		$this->chapter_info = $this->chapter_obj->getChapterInfo();

		if ($this->chapter_info['ch_lock'] != 0)
			$this->error('该章节已经被锁，无法购买');
		if ($this->chapter_info['ch_status'] != 0)
			$this->error('该章节无法购买');
		if ($this->chapter_info['ch_vip'] != 1)
			$this->error('该章节不是vip，无需购买', ZU('read/index', 'ZL_BOOK_DOMAIN', 
						array('book_id'=>$this->book_id, 'ch_id'=>$this->chapter_id)));
		
		return True;
	}
}