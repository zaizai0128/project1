<?php
/**
 * 购买的基类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Buy\Controller;
use Think\Controller;
use Zlib\Api as Zapi;

class BuyController extends Controller {

	protected $book_id;
	protected $chapter_id;
	protected $book_info;
	protected $chapter_info;
	protected $book_obj;
	protected $chapter_obj;

	public function __construct()
	{
		parent::__construct();
		$this->book_id = I('get.book_id');
		$this->chapter_id = I('get.ch_id');
		$this->book_obj = new Zapi\Book($this->book_id);
		$this->chapter_obj = new Zapi\Chapter($this->book_id, $this->chapter_id);

		// 初始化操作
		$this->init();
	}

	protected function init()
	{
		$this->checkAcl();

	}

	// 基本验证
	protected function checkAcl()
	{
		if (empty($this->book_id))
			$this->error('作品序号不允许为空'); 
		if (empty($this->chapter_id)) 
			$this->error('章节序号不允许为空'); 
		if(!$this->book_obj->checkBook()) 
			$this->error('作品不存在');
		if(!$this->chapter_obj->checkChapter()) 
			$this->error('章节不存在');

		$this->book_info = $this->book_obj->getBookInfo();
		$this->chapter_info = $this->chapter_obj->getVipChapterCommodityInfo();

		if ($this->chapter_info['ch_lock'] != 0)
			$this->error('该章节已经被锁，无法购买');
		if ($this->chapter_info['ch_status'] != 0)
			$this->error('该章节无法购买');
		if ($this->chapter_info['ch_vip'] != 1)
			$this->error('该章节不是vip，无需购买', ZU('read/index', 'ZL_BOOK_DOMAIN', 
						array('book_id'=>$this->book_id, 'ch_id'=>$this->chapter_id)));

		return True;
	}

	// 验证用户信息
	protected function checkUserAcl()
	{
		if (!ZS('S.user','?'))
			$this->error('请先登录', ZU('login/index'));

		$this->user_id = ZS('S.user', 'user_id');
		$this->user_obj = new Zapi\User($this->user_id);
		$account_info = $this->user_obj->getAccountInfo();

		if (empty($account_info))
			$this->error('对不起，您的余额不足，请先充值');

		$now = date('Y-m-d', time());

		// 银币在时限之内，并且大于章节的钱，则消耗银币
		if ($account_info['bonus'] >= $this->chapter_info['ch_price'] 
			&& $now <= $account_info['bonus_expire']) {

			$this->cost_type = 2;	// 设置消耗类型为银币

		// 消耗金币
		} else {
			if ($account_info['amount'] >= $this->chapter_info['ch_price']) {
				$this->cost_type = 1;
			} else {
				$this->error('对不起，您的余额不足，请先充值');
			}
		}

		// 已经拥有该章节权限，无需再次购买
		$this->vipBuy = new Zapi\UserVipBuy($this->user_id, $this->book_id);
		$is_buy = $this->vipBuy->isBuyByOrder($this->chapter_info['ch_order']);

		if ($is_buy) {
			$this->error('您已购买此章节，无需购买', ZU('read/index', 'ZL_BOOK_DOMAIN',
					array('book_id'=>$this->book_id, 'ch_id'=>$this->chapter_id)));
		}

		$this->user_info = ZS('S.user');
		$this->user_info = array_merge($this->user_info, $account_info);
		return True;
	}
}