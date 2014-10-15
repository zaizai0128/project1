<?php
/**
 * 购买页面
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Buy\Controller;
use Zlib\Api as Zapi;

class IndexController extends BuyController {

	protected $userInstance = Null;
	protected $userInfo = Null;
	protected $billInstance = Null;
	protected $flowerInstance = Null;	

	public function __construct()
	{
		parent::__construct();

		if (ZS('SESSION.user', '?')) {
			$this->userInstance = D('User', 'Service');
			$this->userInfo = $this->userInstance->getAccountInfo(ZS('SESSION.user', 'user_id'));
		}

		$this->billInstance = D('Bill', 'Service');
		$this->flowerInstance = D('Flower', 'Service');
	}
	
	/**
	 * 购买单个章节的界面
	 */
	public function chapter()
	{	
		$month_cost_total = $this->billInstance->getCostSum($this->userInfo['user_id']);
		// 获取距离下一次赠送鲜花 还需要消费多少
		$next_num = $this->flowerInstance->getNextFlowerNum($this->userInfo['user_id'], $month_cost_total);
		$assign['next_num'] = $next_num;

		// 验证章节信息
		\Zlib\Api\Acl::buy($this->chapterInfo);

		// 获取卷章节
		$volume_list = \Zlib\Api\Book::getCatalog($this->bookId);

		$this->assign(array(
			'assign' => $assign,
			'chapter_info' => $this->chapterInfo,
			'book_info' => $this->bookInfo,
			'volume_list' => $volume_list,
			'user_info' => $this->userInfo,
		));
		$this->display();
	}

	/**
	 * 卷购买
	 */
	public function volume()
	{
		$volume_list = \Zlib\Api\Book::getCatalog($this->bookId, $this->userInfo['user_id']);
		$volume_info = $volume_list[$this->volumeId];
		\Zlib\Api\Acl::buyVolume($volume_info);

		$this->assign(array(
			'book_info' => $this->bookInfo,
			'volume_info' => $volume_info,
			'volume_list' => $volume_list,
			'user_info' => $this->userInfo,
		));
		$this->display();
	}

}