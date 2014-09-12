<?php
/**
 * 待审核作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class BookApplyController extends BaseController {

	protected $_apply_obj;
	protected $book_id;

	protected function _init()
	{
		parent::_init();
		$this->_apply_obj = D('BookApply');
		$this->book_id = I('get.bk_apply_id');
	}

	/**
	 * 待审核作品列表
	 */
	public function index()
	{
		// 获取该用户待审核作品列表
		$book = $this->_apply_obj->getApplyList($this->user_id);

		$this->assign(array(
			'book' => $book
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
		if (empty($this->book_id)) {
			$this->error('请选择要操作的作品');
		}

		// 获取该作者的申请作品信息
		$book = $this->_apply_obj->getInfo($this->book_id, $this->user_id);

		// 如果不存在，返回error
		if (empty($book)) {
			$this->error('作品不存在');
		}
		
		$this->assign(array(
			'book' => $book,
		));
		$this->display();
	}

	/**
	 * 编辑作品信息
	 */
	public function edit()
	{
		if (empty($this->book_id)) {
			$this->error('请选择要操作的作品');
		}

		// 获取该作者的申请作品信息
		$book = $this->_apply_obj->getInfo($this->book_id, $this->user_id);

		// 如果不存在，返回error
		if (empty($book)) {
			$this->error('作品不存在');
		}

		$this->assign(array(
			'book' => $book,
		));
		$this->display();	
	}

	/**
	 * 执行编辑
	 */
	public function doEdit()
	{
		if (IS_POST) {

			dump(I());
		}
	}

}