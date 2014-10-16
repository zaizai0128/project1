<?php
/**
 * 鲜花功能
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace App\Controller;

class FlowerController extends AppController {

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
		$this->flowerInstance = D('Flower', 'Service');
		$this->bookInfo = $this->bookInstance->getBookByBookId($this->bookId);
		$this->userInfo['flower'] = $this->flowerInstance->getUserBookFlower($this->userId, $this->bookId);

		$this->mKey = 'APP#FLOWER#LOCK'.$this->userId;
		$this->_check();
	}

	/**
	 * 验证添加鲜花操作
	 */
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

		// // 只有bk_commision状态 A,Z,Y,X 才允许送鲜花
		// if (!in_array($this->bookInfo['bk_commision'],array('A', 'Z', 'Y', 'X'))) {
		// 	// z_redirect('作品当前的签约状态不允许被赠送鲜花','', 2, -1);
		// 	de('作品当前的签约状态不允许被赠送鲜花');
		// }

		// 每月第一天的 00:30:00 前 不允许赠送鲜花
		if (date('j') == 1 && date('H:i:s') < '00:30:00') {
			z_redirect('上一期鲜花榜已经结束，新一轮的鲜花榜投票0点30分开始!', '', 2, -1);
		}

		// 每次间隔2分钟, 单本作品还是全部作品?
		$lock = S($this->mKey);

		if (!empty($lock)) {
			// 提示等待2分钟再送
			z_redirect('请等待'.($this->expire/60).'分钟，再送。', '', 2, -1);
		}
	}

	/**
	 * 添加鲜花界面
	 */
	public function index()
	{
		$this->assign(array(
			'user_info' => $this->userInfo,
			'book_info' => $this->bookInfo,
		));
		$this->display();
	}

	/**
	 * 添加鲜花
	 */
	public function doAdd()
	{
		if (IS_POST) {
			// 鲜花数
			$flower_num = I('post.num');
			$data['num'] = I('post.num');
			$data['user_info'] = $this->userInfo;
			$data['book_info'] = $this->bookInfo;
			$state = $this->flowerInstance->addFlower($data);

			if ($state['code'] > 0) {

				// 设置lock
				S($this->mKey, 1, $this->expire);
				z_redirect('赠送成功', ZU('', '', 'back'));
			} else {
				z_redirect($state['msg'], '', 2, -1);
			}
		}
	}
}