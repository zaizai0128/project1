<?php
/**
 * 作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class BookController extends BaseController {

	private $_author;
	private $_book;
	private $_book_id;

	public function _init()
	{
		parent::_init();

		$this->_author = new Zapi\Author;
		$this->_book = D('Book');
		
		// 进行书籍与用户拥有的修改权限做比较
		if (ACTION_NAME != 'index') {
			$this->_book_id = I('get.book_id');

			if (empty($this->_book_id)) {
				$this->error('请选择要操作的作品');
			}

			// 验证操作书籍的权限
			if (!in_array($this->_book_id, session('author.book'))) {
				$this->error('您无权操作此书');
			}

			// 获取该作品的信息
			$book = $this->_book->getBookInfo($this->_book_id, $this->user_id);

			// 不存在，返回error
			if (empty($book)) {
				$this->error('作品不存在');
			}
			
			$this->book = $book;
		}
	}

	/**
	 * 作品列表管理
	 */
	public function index()
	{
		// 获取该用户已经审核通过的作品		
		$book_list = $this->_book->getBookListByUid($this->user_id);

		$this->assign(array(
			'book_list' => $book_list
		));
		$this->display();
	}

	/**
	 * 每本作品的管理界面
	 *
	 */
	public function book()
	{
		if (empty($this->_book_id)) {
			$this->error('请选择要操作的作品');
		}

		$book_info = $this->_book->getBookInfo($this->_book_id);

		if (empty($book_info)) {
			$this->error('作品不存在');
		}

		$this->assign(array(
			'book_info' => $book_info,
		));
		$this->display();
	}

	/**
	 * 编辑作品
	 */
	public function edit()
	{
		$book_info = $this->_book->getBookInfo($this->_book_id);

		$this->assign(array(
			'book_info' => $book_info
		));
		$this->display();
	}

	/**
	 * 执行编辑作品
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = I();
			$data['bk_id'] = $this->_book_id;

			$state = $this->_book->editBookInfo($data);

			if ($state > 0)
				$this->success('修改成功', ZU('book/book', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$this->_book_id)));
			else
				$this->error('修改失败');
		}
	}
}