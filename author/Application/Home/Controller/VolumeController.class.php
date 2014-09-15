<?php
/**
 * 分卷管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class VolumeController extends BaseController {

	private $_book_id;
	private $_book_info;

	public function _init()
	{
		parent::_init();

		$this->_book_id = I('get.book_id');
		$this->checkBookAcl($this->_book_id);
		$this->_book_info = D('Book')->getBookInfo($this->_book_id);
	}

	/**
	 * 分卷管理页面
	 */
	public function index()
	{
		
		$this->assign(array(
			'book_info' => $this->_book_info,

		));
		$this->display();
	}

	/**
	 * 执行新增
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data = I();
			dump($data);
		}	
	}

	/**
	 * 修改分卷
	 */
	public function edit()
	{
		
	}

	/**
	 * 执行修改分卷
	 */
	public function doEdit()
	{
		if (IS_POST) {

		}
	}

	/**
	 * 删除分卷
	 */
	public function delete()
	{
		if (IS_POST) {

		}
	}

}