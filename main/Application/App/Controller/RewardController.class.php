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
	protected $rewardInstance = Null;
	protected $mKey = Null;					// 打赏间隔缓存
	protected $expire = 120;				// 打赏间隔2分钟

	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->bookInstance = D('Book', 'Service');
		$this->rewardInstance = D('Reward', 'Service');
		$this->bookInfo = $this->bookInstance->getBookByBookId($this->bookId);

		$this->mKey = 'APP#REWARD#LOCK'.$this->userId;
		$this->_check();
	}
	
	/**
	 * 打赏界面
	 */
	public function index()
	{

		$this->assign(array(
			'book_info' => $this->bookInfo,
			'user_info' => $this->userInfo,
		));
		$this->display();
	}

	/**
	 * 执行打赏
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data['num'] = I('post.num');
			$data['user_info'] = $this->userInfo;
			$data['book_info'] = $this->bookInfo;
			$state = $this->rewardInstance->addReward($data);

			if ($state['code'] > 0) {

				z_redirect('打赏成功', ZU('', '', 'back'));
			} else {
				
				z_redirect($state['msg'], '', 2, -1);
			}
		}
	}

	private function _check()
	{
		// 判断作品是否存在
		if (empty($this->bookInfo)) {
			z_redirect('作品不存在','', 2, -1);
		}
		
		// 判断作品状态，如果bk_staus != 00 作品状态非正常，不允许送鲜花
		if ($this->bookInfo['bk_status'] != '00') {
			z_redirect('作品状态非正常，不允许送鲜花', '', 2, -1);
		}
	}

}