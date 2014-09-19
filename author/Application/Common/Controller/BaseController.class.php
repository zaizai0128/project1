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
	protected $author_info;

	public function __construct()
	{
		parent::__construct();

		// 未登录提示
		if (!session('?user')) {
			$this->error('请登录', ZU('login/index'));
		}

		// 用户状态非作者提示
		if (!in_array(session('user.user_type'), array('02', '03', '04')) ) {
			$this->error('请先申请成为作者，才能继续进行操作', ZU('user/center/index'));
		}

		// 初始化一些动作
		$this->init();
	}

	/**
	 * 初init作者信息
	 */
	protected function init()
	{
		// 获取用户id
		$this->user_id = session('user.user_id');

		// 通过用户id获取作者的全部信息，保存到session中
		// 作者站的用户信息全部通过author获取
		if (!session('author')) {
			$author = new Zapi\Author;
			$author_info = $author->getInfo($this->user_id, True);
			session('author', $author_info);
		}

		$this->author_info = session('author');
	}

	/**
	 * 验证作品操作权限
	 */
	public function checkBookAcl()
	{
		// 添加忽略权限验证的操作
		if (in_array(CONTROLLER_NAME.'.'.ACTION_NAME, array('Book.index')))
			return True;
		
		if (empty($this->book_id))
			$this->error('请选择要操作的作品');

		// 获取该作者所拥有的书籍
		$author_book = $this->book_obj->getOwnBook($this->user_id);

		if (!in_array($this->book_id, $author_book))
			$this->error('您无权操作此书');

		if (!$this->book_obj->checkBookExist($this->book_id) )
			$this->error('作品不存在');
		
		return True;
	}

	/**
	 * 验证章节操作权限
	 */
	protected function checkChapterAcl()
	{
		$this->checkBookAcl();
		
	}

	/**
	 * 验证申请作品操作权限
	 */
	protected function checkBookApplyAcl()
	{
		// 添加忽略的文件
		if (in_array(CONTROLLER_NAME.'.'.ACTION_NAME,
			array('BookApply.index'))) 
			return True;

		if (empty($this->book_id))
			$this->error('请选择要操作的作品');

		// 获取该作者正在审核的书籍
		$author_book_apply = $this->book_apply_obj->getOwnBook($this->user_id);

		if (!in_array($this->book_id, $author_book_apply))
			$this->error('您无权操作此书');

		if (!$this->book_apply_obj->checkBookExist($this->book_id) )
			$this->error('作品不存在');
		
		return True;
	}

	/**
	 * 验证申请作品章节的操作权限
	 */
	protected function checkChapterApplyAcl()
	{
		$this->checkBookApplyAcl();


	}
}