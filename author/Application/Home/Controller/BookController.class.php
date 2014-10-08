<?php
/**
 * 作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;

class BookController extends HomeController {

	protected $bookId = Null;
	protected $bookInstance = Null;

	protected function init()
	{
		parent::init();
		$this->bookId = I('get.book_id');
		\Zlib\Api\Acl::check($this->authorInfo, $this->bookId);
		$this->bookInstance = D('Book', 'Service');
	}

	/**
	 * 作品列表管理
	 */
	public function index()
	{
		// 获取该作者已经审核通过的作品		
		$book_list = $this->bookInstance->getBookByUserId($this->authorInfo['user_id']);

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
		$book_info = $this->bookInstance->getBookByBookId($this->bookId);

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
		$book_info = $this->bookInstance->getBookByBookId($this->bookId);

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
			$data = array_merge($this->authorInfo, I(), array('bk_id'=>$this->bookId));
			$state = $this->bookInstance->doEditBookInfo($data);

			if ($state['code'] > 0)
				z_redirect('修改成功', ZU('book/book', 'ZL_AUTHOR_DOMAIN'
								, array('book_id'=>$this->bookId)));
			else
				z_redirect('修改失败');
		}
	}

	/**
	 * 申请签约
	 *
	 */
	public function applyVip()
	{
		$assign = array();
		$book_info = $this->bookInstance->getBookByBookId($this->bookId, 'bk_id,bk_name');
		// 获取签约状态，已经签约，则显示审核状态
		$apply_info = D('BookApplyVip', 'Service')->getInfoByBookId($this->bookId);
		$assign['is_show'] = empty($apply_info) ? True : False;

		$this->assign(array(
			'assign' => $assign,
			'apply_info' => $apply_info,
			'book_info' => $book_info,
		));
		$this->display();
	}

	/**
	 * 执行申请签约
	 */
	public function doApplyVip()
	{
		if (IS_POST) {
			$data = $this->bookInstance->getBookByBookId($this->bookId);
			$data['apply_comments'] = I('post.apply_comments');
			$state = D('BookApplyVip', 'Service')->doAdd($data);

			if ($state['code'] > 0) {
				z_redirect($state['msg'], ZU('book/applyVip', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$this->bookId)));
			} else {
				z_redirect($state['msg']);
			}
		}
	}
}