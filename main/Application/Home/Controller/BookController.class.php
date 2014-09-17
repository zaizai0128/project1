<?php
/**
 * 作品封面页
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class BookController extends HomeController {

	protected $book_api = Null;
	protected $book_id = Null;
	protected $book_info = Null;

	public function __construct()
	{
		parent::__construct();
		$this->book_id = I('get.book_id');
		$this->checkBookAcl();
	}

	/**
	 * 封面首页
	 */
	public function index()
	{
		// 其他一些赋值
		$assign = array();	

		// 获取作品分类路径
		$book_cate = Zapi\BookClass::getInstance()->getPathArray($this->book_info['bk_class_id']); 

		// 获取作品类型
		$assign['category'] = $book_cate[substr($this->book_info['bk_class_id'], 0, 2)]['name']; 

		// 获取点击排名
		$assign['rank'] = $this->book_api->getAllRank();	
		
		$this->assign(array(
			'assign' => $assign,
			'book_info' => $this->book_info,
			'book_cate' => $book_cate,
		));
		$this->display();
	}
	
}