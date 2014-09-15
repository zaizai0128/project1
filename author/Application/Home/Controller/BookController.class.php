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

	private $_author;		// 作者接口对象
	private $_book_obj;		// db对象
	private $_book_id;		// 书籍id 
	private $_book_info;	// 书籍信息

	public function _init()
	{
		parent::_init();

		$this->_author = new Zapi\Author;
		$this->_book_obj = D('Book');
		$this->_book_id = I('get.book_id');
		$this->checkBookAcl($this->_book_id);
		$this->_book_info = $this->_book_obj->getBookInfo($this->_book_id);
	}

	/**
	 * 作品列表管理
	 */
	public function index()
	{
		// 获取该作者已经审核通过的作品		
		$book_list = $this->_book_obj->getBookListByUid($this->user_id);

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

		$this->assign(array(
			'book_info' => $this->_book_info,
		));
		$this->display();
	}

	/**
	 * 编辑作品
	 */
	public function edit()
	{

		$this->assign(array(
			'book_info' => $this->_book_info
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

			$state = $this->_book_obj->editBookInfo($data);

			if ($state > 0)
				$this->success('修改成功', ZU('book/book', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$this->_book_id)));
			else
				$this->error('修改失败');
		}
	}
}