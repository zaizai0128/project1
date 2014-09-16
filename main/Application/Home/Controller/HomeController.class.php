<?php
/**
 * controller 基类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */
namespace Home\Controller;
use Think\Controller;
use Zlib\Api as Zapi;

class HomeController extends Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 验证书籍
	 *
	 * @param int book_id
	 */
	public function checkBookAcl($book_id)
	{
		if (empty($book_id))
			$this->error('作品不存在');
		
		$zapi_book = new Zapi\Book($book_id);

		if (!$zapi_book->checkBook())
			$this->error('作品不存在');

		return True;
	}
}