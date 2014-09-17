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

	protected $book_apply_obj;
	protected $book_id;					// 作品id
	protected $book_info;				// 作品的信息

	protected function init()
	{
		parent::init();
		$this->book_apply_obj = D('BookApply', 'Service');
		$this->book_id = I('get.bk_apply_id');

		// 验证权限
		$this->checkBookApplyAcl($this->_book_id);
		$this->book_info = $this->book_apply_obj->getApplyInfo($this->book_id);
	}

	/**
	 * 待审核作品列表
	 */
	public function index()
	{
		// 获取该用户待审核作品列表
		$book = $this->book_apply_obj->getApplyList($this->user_id);

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
		
		$this->assign(array(
			'book' => $this->book_info,
		));
		$this->display();
	}

	/**
	 * 编辑作品信息
	 */
	public function edit()
	{

		$this->assign(array(
			'book' => $this->_book_info,
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