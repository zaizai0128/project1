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
}