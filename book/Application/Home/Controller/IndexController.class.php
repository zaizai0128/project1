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
	}

	/**
	 * 作品的目录页
	 */
	public function index()
	{
		// 获取作品分类
		$book_cate = $this->book_class_api->getPathArray($this->book_info['bk_class_id']);
		
		$user_id = ZS('S.user', 'user_id');
		// 获取章节分卷加目录
		$catalog = $this->book_api->getCatalog($user_id);

		$this->assign(array(
			'book_cate' => $book_cate,
			'book_info' => $this->book_info,
			'catalog' => $catalog,
		));
		$this->display();
	}
}