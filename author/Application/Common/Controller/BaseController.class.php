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
use Zlib\Api\Author;

class BaseController extends Controller {

	protected $user_id;

	public function __construct()
	{
		parent::__construct();

		if (!session('user')) {
			$this->error('请登录', ZU('/login/index'));
		}

		if (!in_array(session('user.user_type'), array('02', '03')) ) {
			$this->error('请先申请成为作者，才能继续进行操作', ZU('user/center/index'));
		}

		$this->_init();
	}

	/**
	 * 初init作者信息
	 */
	public function _init()
	{
		$this->user_id = session('user.user_id');

		// 通过用户id获取作者的全部信息，保存到session中
		if (!session('author')) {

			$author = new Author;
			$author_info = $author->getInfo($this->user_id, True);
			session('author', $author_info);
		}
	}
}