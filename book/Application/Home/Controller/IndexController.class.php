<?php
/**
 * 作品的目录页controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;

class IndexController extends HomeController {

	/**
	 * 作品的目录页
	 */
	public function index()
	{
		// 获取作品分类
		$book_cate = $this->bookClassApi->getPathArray($this->bookInfo['bk_class_id']);

		// 获取章节分卷加目录
		$catalog = $this->bookApi->getCatalog(ZS('SESSION.user', 'user_id'));

		$this->assign(array(
			'book_cate' => $book_cate,
			'book_info' => $this->bookInfo,
			'catalog' => $catalog,
		));
		$this->display();
	}
}