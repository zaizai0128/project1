<?php
/**
 * 个人书架controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace User\Controller;

class ShelfController extends UserController {

	protected $bookShelfApi = Null;
	protected $bookShelfInstance = Null;
	protected $shelfId = Null;
	protected $category = Null;

	public function __construct()
	{
		parent::__construct();
		$this->shelfId = I('get.shelf_id');
		$this->bookShelfApi = new \Zlib\Api\BookShelf($this->userId);
		$this->bookShelfInstance = D('BookShelf', 'Service')->getInstance($this->userId, $this->shelfId);
		$bookClass = \Zlib\Api\BookClass::getInstance();
		$this->category = $bookClass->getClass();

		$this->init();
	}

	protected function init()
	{
		parent::init();

		$this->assign(array(
			'category' => $this->category,
		));
	}

	/**
	 * 书架首页
	 */
	public function index()
	{
		$assign = array();
		// 获取默认书架的全部书籍
		$assign['total'] = $this->bookShelfInstance->getTotalBooks(C('SHELF.default_num'));
		$book_list = $this->bookShelfApi->getBooks(C('SHELF.default_num'));
		$limit = 2;
		$Page = new \Think\Page($assign['total'], $limit);
		$show = $Page->show();
		$book_list = array_slice($book_list, $Page->firstRow, $Page->listRows);


		$this->assign(array(
			'assign' => $assign,
			'book_list' => $book_list,
			'page' => $show,
		));
		$this->display();
	}

	/**
	 * 最近阅读
	 */
	public function history()
	{
		
		$this->display();
	}

	/**
	 * 书架管理
	 */
	public function manager()
	{

		$shelf_list = $this->bookShelfApi->getShelfList();
		
		$this->assign(array(
			'shelf_list' => $shelf_list,
		));
		$this->display();
	}

	/**
	 * 创建书架
	 */
	public function add()
	{
		$id = $this->bookShelfInstance->doAdd();

		if ($id > 0) {
			z_redirect('创建成功', ZU('user/shelf/manager'));
		} else {
			z_redirect('创建失败');
		}
	}

	/**
	 * 修改书架名称
	 */
	public function edit()
	{
		if (!IS_AJAX) {
			return false;
		}

		$data['bookshelf_name'] = I('post.name');
		$data['bookshelf_id'] = $this->shelfId;
		$data['user_id'] = $this->userId;
		$state = $this->bookShelfInstance->doEdit($data);

		if ($state>0)
			$this->ajaxReturn(z_info(1, '修改成功'));
		else
			$this->ajaxReturn(z_info(0, '修改失败'));
	}
}