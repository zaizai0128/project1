<?php
/**
 * cost操作
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Buy\Controller;

class CostController extends BuyController {

	protected $userInstance = Null;
	protected $billInstance = Null;
	protected $discountInstance = Null;
	protected $flowerInstance = Null;
	protected $userInfo = Null;
	protected $costType = Null;	// 消耗的金币类型 1金币 2银币
	protected $vipBuy = null;		

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = D('User', 'Service');
		$this->userInfo = $this->userInstance->getAccountInfo(ZS('SESSION.user', 'user_id'));
		$this->discountInstance = D('Discount', 'Service');
		$this->billInstance = D('Bill', 'Service');
		$this->flowerInstance = D('Flower', 'Service');
		$this->vipBuy = new \Zlib\Api\UserVipBuy($this->userInfo['user_id'], $this->bookId);
	}

	/**
	 * 执行卷购买流程
	 */
	public function doCostVolume()
	{
		if (!IS_AJAX) {
			return ;
		}

		$chapter_ids = I('item_id');
		// 获取卷章节
		$volume_list = \Zlib\Api\Book::getCatalog($this->bookId);
		$volume_info = $volume_list[$this->volumeId];
		$this->costType = \Zlib\Api\Acl::costVolume($this->userInfo, $this->bookInfo, $volume_info, $chapter_ids);

		if (!$this->costType)
			$this->ajaxReturn(z_info(-1, '订阅信息有错误'));

		// 获取要购买的章节
		$chapter_ids = explode(',', $chapter_ids);
		$buy_chapter = array();
		$total_price = 0;
		foreach($chapter_ids as $chapter_id) {

			// 取消掉已经购买 和 非vip章节
			if ($volume_info['volume_chapter'][$chapter_id]['chapter_own'] || $volume_info['volume_chapter'][$chapter_id]['chapter_vip'] != 1) {
				continue;
			}

			$buy_chapter[$chapter_id] = $volume_info['volume_chapter'][$chapter_id];
			$total_price += (int)$volume_info['volume_chapter'][$chapter_id]['chapter_price'];
		}

		// 执行批量购买
		$state = $this->_doCostMul($this->userInfo, $this->bookInfo, $volume_info, $buy_chapter, $total_price);

		$this->ajaxReturn($state);
	}

	/**
	 * 用户信息
	 * 作品信息
	 * 卷信息
	 * 购买的章节信息
	 * 总共花费的价钱
	 */
	private function _doCostMul($user_info, $book_info, $volume_info, $chapter_info, $price)
	{
		// 查询本书的活动
		$discount_type = $this->discountInstance->getDiscountInfo($book_info['bk_id']);

		// 有活动，则对该章节的价格进行相应的折扣
		if ($discount_type != 0) {
			$price *= $discount_type;// 该类型对应的基数
		}

		// 开启事务
		$db = M();
		$db->startTrans();

		// 获取每一步的操作结果
		$result = array();

		// 银行账户减少金币
		if ($this->costType == 1) {
			$result['accounts'] = $db->table('zl_accounts')->where('oid = '.$user_info['user_id'])
			->setDec('amount', $price);
		// 银币
		} else if ($this->costType == 2) {
			$result['accounts'] = $db->table('zl_accounts')->where('oid = '.$user_info['user_id'])
			->setDec('bonus', $price);
		}

		// 拼出多个数组，每个数组保留自己区域的 from ~ to 章节order
		// 保证章节号是从小到大
		ksort($chapter_info);
		// 存放章节段的数组
		$interval_array = array();
		$start_interval = 0;	// 第一段
		$start_chapter_arr = current($chapter_info);	// 起始章节的信息
		$start_order = $start_chapter_arr['chapter_order']; // 起始order
		foreach($chapter_info as $chapter_id => $val) {
			$tmp['id'] = $chapter_id;
			$tmp['name'] = $val['chapter_name'];
			$tmp['size'] = $val['chapter_size'];
			$tmp['price'] = $val['chapter_price'];

			// 如果开始没有间断，则保留永远在第一段
			if ($start_order == $val['chapter_order']) {
				$interval_array[$start_interval]['order'][] = $val['chapter_order'];
				$interval_array[$start_interval]['chapter'][] = $tmp;
			// 如果有了间隔，则放在第++段
			} else {
				$start_order = $val['chapter_order'];	// 重新归位start_order
				++$start_interval;
				$interval_array[$start_interval]['order'][] = $val['chapter_order'];
				$interval_array[$start_interval]['chapter'][] = $tmp;
			}
			++$start_order;
		}

		// 循环数组，为不同区域进行购买章节，添加流水
		foreach ($interval_array as $key => $val) {
			$order = $val['order'];
			$buy_chapter = $val['chapter'];
			$res_key = 'buy'.$key;
			$log_key = 'log'.$key;
			$order_from = min($order);
			$order_to = max($order);
			
			// 如果章节个数不大于1，则使用单章节购买的方式，否则才使用多章节购买
			if (count($order) <= 1)
				$result[$res_key] = $this->vipBuy->setBuyByOrder($order_from);
			else
				$result[$res_key] = $this->vipBuy->setBuyByOrderMulti($order_from, $order_to);

			// 添加流水账单
			$bill = array();
			$bill['user_id'] = $user_info['user_id'];
			$bill['user_name'] = $user_info['user_name'];
			$bill['user_type'] = $user_info['user_type'];
			$bill['bk_id'] = $book_info['bk_id'];
			$bill['bk_name'] = $book_info['bk_name'];
			$bill['chapter'] = serialize($buy_chapter);
			$bill['author_id'] = $book_info['bk_author_id'];
			$bill['author_name'] = $book_info['bk_author'];

			// 计算每一区间章节消耗的价格
			$price_chapter = array_map(function($v){
				return $v['price'];
			}, $buy_chapter);
			$bill['pay_money'] = array_sum($price_chapter);
			$bill['pay_type'] = $this->costType;
			$bill['buy_num'] = count($order);
			$bill['buy_type'] = 2;
			$bill['discount_type'] = $discount_type; // 折扣类型
			$bill['time'] = z_now();
			$bill['status'] = 1;

			// 生成购买章节描述
			$buy_chapter = array_map(function($v) {
				return $v['name'];
			}, $buy_chapter);
			$str_chapter = implode('，', $buy_chapter);
			$bill['detail'] = $user_info['user_name'].'购买'.$book_info['bk_author'].'写的《'
								.$book_info['bk_name'].'》作品的卷《'.$volume_info['volume_name'].'》的章节《'.$str_chapter.'》，很是开心。';					

			$bill['from_ch_order'] = $order_from;
			$bill['to_ch_order'] = $order_to;
			// 记录到流水					
			$result[$log_key] = $this->billInstance->doAdd($bill);	
		}
		
		// 添加鲜花操作
		$result['flower'] = $this->_addFlower();

		// 如果购买成功
		if (array_product($result) >= 1)
		{
			$db->commit();
			// z_redirect('购买成功', ZU('index/index', 'ZL_BOOK_DOMAIN', array('book_id'=>$this->bookId)));
			return z_info(1, '购买成功');
		} else {
			$db->rollback();
			// 记录到error_log中
			// z_redirect('购买失败，请重新尝试');
			return z_info(0, '购买失败，请重新尝试');
		}
	}

	/**
	 * 执行购买流程
	 */
	public function doCost()
	{
		$this->costType = \Zlib\Api\Acl::cost($this->userInfo, $this->bookInfo, $this->chapterInfo);

		// 查询本书的活动
		$discount_type = $this->discountInstance->getDiscountInfo($this->bookId);
		$price = $this->chapterInfo['ch_price'];

		// 有活动，则对该章节的价格进行相应的折扣
		if ($discount_type != 0) {
			$price *= $discount_type;// 该类型对应的基数
		}

		// 获取每一步的操作结果
		$result = array();

		$db = M();
		// 开启事务
		$db->startTrans();

		// 用户zl_accounts 减 对应的价钱
		// 金币
		if ($this->costType == 1) {
			$result['accounts'] = $db->table('zl_accounts')->where('oid = '.$this->userInfo['user_id'])
			->setDec('amount', $price);
		// 银币
		} else if ($this->costType == 2) {
			$result['accounts'] = $db->table('zl_accounts')->where('oid = '.$this->userInfo['user_id'])
			->setDec('bonus', $price);
		}
		
		// 记录到流水
		$bill = array();
		$bill['user_id'] = $this->userInfo['user_id'];
		$bill['user_name'] = $this->userInfo['user_name'];
		$bill['user_type'] = $this->userInfo['user_type'];
		$bill['bk_id'] = $this->bookId;
		$bill['bk_name'] = $this->bookInfo['bk_name'];

		$tmp = array();
		$tmp['id'] = $this->chapterInfo['ch_id'];
		$tmp['name'] = $this->chapterInfo['ch_name'];
		$tmp['size'] = $this->chapterInfo['ch_size'];
		$tmp['price'] = $price;

		$bill['chapter'] = serialize(array($tmp));
		$bill['author_id'] = $this->bookInfo['bk_author_id'];
		$bill['author_name'] = $this->bookInfo['bk_author'];
		$bill['pay_money'] = $price;
		$bill['pay_type'] = $this->costType;
		$bill['buy_num'] = 1;
		$bill['buy_type'] = 1;
		$bill['discount_type'] = $discount_type; // 折扣类型
		$bill['time'] = z_now();
		$bill['status'] = 1;
		$bill['detail'] = $this->userInfo['user_name'].'购买'.$this->bookInfo['bk_author'].'写的《'
							.$this->bookInfo['bk_name'].'》作品的《'.$this->chapterInfo['ch_name'].'》，很是开心。';					
		$bill['from_ch_order'] = $this->chapterInfo['ch_order'];
		$bill['to_ch_order'] = $this->chapterInfo['ch_order'];
		
		// 记录到流水					
		$result['bill'] = $this->billInstance->doAdd($bill);				
			
		// 为用户添加购买后的权限
		$result['buy'] = $this->vipBuy->setBuyByOrder($this->chapterInfo['ch_order']);

		// 添加鲜花操作
		$result['flower'] = $this->_addFlower();

		// 如果购买成功
		if (array_product($result) >= 1)
		{
			$db->commit();
			z_redirect('购买成功', ZU('read/index', 'ZL_BOOK_DOMAIN', 
							array('book_id'=>$this->bookId, 'ch_id'=>$this->chapterId)));
		} else {
			$db->rollback();
			// 记录到error_log中
			z_redirect('购买失败，请重新尝试');
		}
	}

	/**
	 * 添加鲜花
	 */
	private function _addFlower()
	{
		// 获取当月消费总额
		$month_cost_total = $this->billInstance->getCostSum($this->userInfo['user_id']);
		// 获取当月用户的鲜花总数
		$flower_have_total = $this->flowerInstance->getFlowerSum($this->userInfo['user_id']);
		// 获取应该赠送的鲜花数
		$add_flower_num = $this->flowerInstance->getAddFlowerNum($month_cost_total, $flower_have_total);
		$flower['num'] = $add_flower_num;
		$flower['total_num'] = $flower_have_total;
		$flower['user_id'] = $this->userInfo['user_id'];
		return $this->flowerInstance->addFlower($flower);
	}
}
