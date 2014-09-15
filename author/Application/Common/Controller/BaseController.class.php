<?php
/**
 * 作者站 父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Common\Controller;
use Think\Controller;
use Zlib\Api as Zapi;

class BaseController extends Controller {

	// 用户id
	protected $user_id;

	public function __construct()
	{
		parent::__construct();

		// 未登录提示
		if (!session('user')) {
			$this->error('请登录', ZU('/login/index'));
		}

		// 用户状态非作者提示
		if (!in_array(session('user.user_type'), array('02', '03', '04')) ) {
			$this->error('请先申请成为作者，才能继续进行操作', ZU('user/center/index'));
		}

		// 初始化一些动作
		$this->_init();
	}

	/**
	 * 初init作者信息
	 */
	protected function _init()
	{
		// 获取用户id
		$this->user_id = session('user.user_id');

		// 通过用户id获取作者的全部信息，保存到session中
		// 作者站的用户信息全部通过author获取
		if (!session('author')) {
			
			$author = new Zapi\Author;
			$author_info = $author->getInfo($this->user_id, True);

			// 获取该作者所拥有的书籍
			$author_book = D('Book')->getOwnBook($this->user_id);
			// 获取该作者正在审核的书籍
			$author_book_apply = D('BookApply')->getOwnBook($this->user_id);

			// 保存作者可以修改的书
			$author_info['book'] = $author_book;
			$author_info['book_apply'] = $author_book_apply;
			
			session('author', $author_info);
		}
	}
}