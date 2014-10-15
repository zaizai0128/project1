<?php
/**
 * 打赏功能
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace App\Controller;

class RewardController extends AppController {

	protected $bookId = Null;
	protected $bookInfo = Null;
	protected $bookInstance = Null;
	protected $flowerInstance = Null;
	protected $mKey = Null;					// 投票间隔缓存
	protected $expire = 120;				// 投票间隔2分钟

	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->bookInstance = D('Book', 'Service');
		$this->flowerInstance = D('Reward', 'Service');
		$this->bookInfo = $this->bookInstance->getBookByBookId($this->bookId);
		$this->userInfo['flower'] = $this->flowerInstance->getFlower($this->userId, $this->bookId);

		$this->mKey = 'APP#FLOWER#LOCK'.$this->userId;
		$this->_check();
	}
	
	/**
	 * 打赏界面
	 */
	public function index()
	{

		$this->display();
	}

	/**
	 * 执行打赏
	 */
	public function doAdd()
	{

		de('为作品进行打赏');
	}

}