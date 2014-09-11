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

	public function __construct()
	{
		parent::__construct();

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
		$auth_info = $this->_author->getInfo($this->user_id, True);
		$book_class = Zapi\BookClass::getInstance()->getAllClassForJson();

		// dump($book_class);

		$this->assign(array(
			'book_class' => $book_class,
			'auth_info' => $auth_info
		));
		$this->display();
	}

	/**
	 * 提交新建作品
	 */
	public function doCreateNewBook()
	{
		if (IS_POST) {

			dump(I());
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