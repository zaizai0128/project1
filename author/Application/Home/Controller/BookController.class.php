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

	protected $_author;
	private $_book;

	public function _init()
	{
		parent::_init();

		$this->_author = new Zapi\Author;
		$this->_book = D('Book');
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
	 * @param int $book_id
	 */
	public function book()
	{
		$book_id = I('book_id');

		if (empty($book_id)) {
			$this->error('请选择要操作的作品');
		}

		$book_info = $this->_book->getBookInfo($book_id);

		if (empty($book_info)) {
			$this->error('作品不存在');
		}

		$this->assign(array(
			'book_info' => $book_info,
		));
		$this->display();
	}

	/**
	 * 新建作品
	 */
	public function createNewBook()
	{	
		$book_class = Zapi\BookClass::getInstance()->getAllClassForJson();

		$this->assign(array(
			'book_class' => $book_class,
		));
		$this->display();
	}

	/**
	 * 提交新建作品
	 */
	public function doCreateNewBook()
	{
		if (IS_POST) {
			
			$data = I();
			$book_service = D('Book', 'Service');
			$state = $book_service->checkBook($data);

			if ($state['code'] < 0)
				$this->error($state['msg']);

			$data['bk_author'] = session('author.author_name');
			$data['bk_author_id'] = $this->user_id;
			$data['bk_poster_id'] = $this->user_id;

			$book_apply_obj = D('BookApply');
			$book_id = $book_apply_obj->doAdd($data);

			if ($book_id) {
				
				// 添加作品后的动作，更新书籍的权限
				$data['bk_id'] = $book_id;
				$tag['data'] = $data;
				$tag['ac'] = 'after_add';
				tag('book', $tag);

				$this->success('添加成功等待审核', ZU('/book/book', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$book_id)));
			} else {

				$this->error('添加失败');
			}
		}
	}

	/**
	 * 新建作品说明
	 */
	public function createNewBookHelp()
	{
		$content = file_get_contents('http://www.zhulang.com/htmpage/zpschuan.html');
		$this->show($content);
	}
}