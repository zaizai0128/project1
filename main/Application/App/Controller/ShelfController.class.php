<?php
/**
 * 书架功能
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-29
 * @version 1.0
 */
namespace App\Controller;
use \Zlib\Api\BookShelf;

class ShelfController extends AppController {

	protected $shelfInstance = Null;
	protected $bookId = Null;
	protected $shelfNum = 0;

	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->shelfInstance = new BookShelf($this->userId);
	}

	/**
	 * 添加到收藏
	 */
	public function add()
	{
		$this->shelfInstance->addBook($this->shelfNum, $this->bookId);
		z_redirect('添加成功');
	}

}