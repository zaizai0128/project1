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
	protected $book_id;				// 请求作品id
	protected $book;				// 该作品的信息

	protected function _init()
	{
		parent::_init();
		$this->_apply_obj = D('BookApply');
	
		// 进行书籍与用户拥有的修改权限做比较
		if (ACTION_NAME != 'index') {

			$this->book_id = I('get.bk_apply_id');

			if (empty($this->book_id)) {
				$this->error('请选择要操作的作品');
			}

			// 验证操作书籍的权限
			if (!in_array($this->book_id, session('author.book_apply'))) {
				$this->error('您无权操作此书');
			}

			// 获取该作品的信息
			$book = $this->_apply_obj->getInfo($this->book_id, $this->user_id);

			// 不存在，返回error
			if (empty($book)) {
				$this->error('作品不存在');
			}
			
			$this->book = $book;
		}
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