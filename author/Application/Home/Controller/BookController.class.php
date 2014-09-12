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

	public function _init()
	{
		parent::_init();

		$this->_author = new Zapi\Author;
	}

	/**
	 * 作品列表管理
	 */
	public function index()
	{
		// 读取该作者一共拥有的书籍，遍历显示

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

		// 判断bookid是否存在，不存在，返回error
		if (False) {
			$this->error('作品不存在');
		}

		$book_info['book_id'] = $book_id;

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

			if ($book_id)
				$this->success('添加成功等待审核', ZU('/book/book', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$book_id)));
			else
				$this->error('添加失败');
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