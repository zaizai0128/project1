<?php
/**
 * 个人书架controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace User\Controller;

class ShelfController extends UserController {

	protected $bookShelfApi = Null;

	public function __construct()
	{
		parent::__construct();
		$this->bookShelfApi = new \Zlib\Api\BookShelf($this->userId);
	}

	/**
	 * 书架首页
	 */
	public function index()
	{
		

		$this->display();
	}

	/**
	 * 最近阅读
	 */
	public function history()
	{
		
		$this->display();
	}

	/**
	 * 书架管理
	 */
	public function manager()
	{

		$this->display();
	}
}