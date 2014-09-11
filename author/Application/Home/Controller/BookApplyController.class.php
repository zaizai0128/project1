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

	public function __construct()
	{
		parent::__construct();

		$this->_apply_obj = D('BookApply');
	}

	/**
	 * 待审核作品列表
	 */
	public function index()
	{
		// 获取该用户待审核作品列表
		$book = $this->_apply_obj->where('bk_author_id='.$this->user_id.' and bk_apply_status != "01"')
				->order('bk_id DESC')->select();

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
		$book_id = I('bk_apply_id');

		if (empty($book_id)) {
			$this->error('请选择要操作的作品');
		}

		$book = $this->_apply_obj->where('bk_id = '.$book_id.' and bk_author_id='.$this->user_id.' and bk_apply_status != "01"')
				->find();

		// 判断bookid是否存在，不存在，返回error
		if (empty($book)) {
			$this->error('作品不存在');
		}

		$this->assign(array(
			'book' => $book,
		));
		$this->display();
	}

}