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

	public function __construct()
	{
		parent::__construct();

		$this->book_id = I('get.book_id');
	}

	/**
	 * 验证
	 * @param int 		book_id
	 * @param boolean 	是否是vip
	 */
	public function checkBookAcl($book_id, $is_vip = False)
	{
		if (empty($book_id))
			$this->error('作品不存在');

		$zapi_book = new Zapi\Book($book_id);

		if (!$zapi_book->checkBook())
			$this->error('作品不存在');

		return True;
	}
}