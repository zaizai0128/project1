<?php
/**
 * 调查管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class SurveyController extends BaseController {

	protected $_author;
	private $_book;
	private $_book_id;

	public function _init()
	{
		parent::_init();

		$this->_author = new Zapi\Author;
		$this->_book = D('Book');
		$this->_book_id = I('get.book_id');
	}

	/**
	 * 调查管理页面
	 */
	public function index()
	{
		$book_info = $this->_book->getBookInfo($this->_book_id);
		
		$this->assign(array(
			'book_info' => $book_info,
		));
		$this->display();
	}

	/**
	 * 创建调查问卷
	 */
	public function doAdd()
	{
		if (IS_POST) {

			dump(I());
		}
	}

}