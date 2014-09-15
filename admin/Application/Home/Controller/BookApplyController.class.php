<?php
/**
 * 待审核作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class BookApplyController extends BaseController {

	protected $_apply_obj;

	protected function _init()
	{
		parent::_init();
		$this->_apply_obj = D('BookApply');
	}

	/**
	 * 待审核作品列表
	 */
	public function index()
	{
		// 获取待审核作品总数
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
		
		$this->assign(array(
			'book' => $this->book,
		));
		$this->display();
	}

	/**
	 * 编辑作品信息
	 */
	public function edit()
	{

		$this->assign(array(
			'book' => $this->book,
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