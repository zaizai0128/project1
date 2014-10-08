<?php
/**
 * 待审核作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Controller;

class BookApplyController extends HomeController {

	protected $bookId = Null;
	protected $bookApplyInstance = Null;

	protected function init()
	{
		parent::init();
		$this->bookId = I('get.apply_id');
		\Zlib\Api\Acl::apply($this->authorInfo, $this->bookId);
		$this->bookApplyInstance = D('BookApply', 'Service');
	}

	/**
	 * 新建作品
	 */
	public function add()
	{
		// 获取类别json
		$book_class = \Zlib\Api\BookClass::getInstance()->getAllClassForJson();

		$this->assign(array(
			'book_class' => $book_class,
			'author_info' => $this->authorInfo,
		));
		$this->display();
	}

	/**
	 * 提交新建作品
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data = array_merge($this->authorInfo, I());
			$state = $this->bookApplyInstance->doAdd($data);

			if ($state['code'] > 0) {
				$book_id = $state['code'];
				z_redirect('添加成功', ZU('bookApply/book', 'ZL_AUTHOR_DOMAIN', array('apply_id'=>$book_id)));
			} else {
				z_redirect('添加失败');
			}
		}
	}

	/**
	 * 待审核作品列表
	 */
	public function index()
	{
		// 获取该用户待审核作品列表
		$book_list = $this->bookApplyInstance->getApplyBookByUserId($this->authorInfo['user_id']);

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
		$book_info = $this->bookApplyInstance->getOneApplyBook($this->authorInfo['user_id'], $this->bookId);

		$this->assign(array(
			'book_info' => $book_info,
		));
		$this->display();
	}
}