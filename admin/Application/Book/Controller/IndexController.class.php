<?php
/**
 * 作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Book\Controller;
use Common\Controller\BaseController;

class IndexController extends BaseController {

	protected $bookInstance = Null;

	public function __construct()
	{
		parent::__construct();

		$this->bookInstance = D('Book', 'Service');
	}

	public function index()
	{
		$class = \Zlib\Api\BookClass::getInstance()->getClass();
		$assign['class'] = $class;

		$total = $this->bookInstance->getBookTotal();
		$Page = new \Think\Page($total, C('ADMIN.list_size'));
		$have_page['firstRow'] = $Page->firstRow;
		$have_page['listRows'] = $Page->listRows;
		$book_list = $this->bookInstance->getBookList($have_page);

		$this->assign(array(
			'assign' => $assign,
			'page' =>  $Page->show(),
			'book_list' => $book_list,
		));
		$this->display();
	}

}