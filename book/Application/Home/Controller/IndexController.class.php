<?php
/**
 * 作品的目录页controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class IndexController extends HomeController {

	public function __construct()
	{
		parent::__construct();
		$this->checkBookAcl();
	}

	/**
	 * 普通作品的目录页
	 */
	public function index()
	{
		// 获取作品分类
		$book_cate = Zapi\BookClass::getInstance()->getPathArray($this->book_info['bk_class_id']);
			
		// 获取chapter章节 tmp
		$chapter = M(Zapi\Chapter::getName($this->book_id))->where('bk_id = '.$this->book_id.' and ch_vip = 0')->select();
		$vip_chapter = M(Zapi\Chapter::getName($this->book_id))->where('bk_id = '.$this->book_id.' and ch_vip = 1')->select();

		$this->assign(array(
			'book_cate' => $book_cate,
			'book_info' => $this->book_info,
			'chapter' => $chapter,
			'vip_chapter' => $vip_chapter,
		));
		$this->display();
	}

	/**
	 * vip作品的目录页
	 */
	public function vip()
	{
		// pass
	}
}