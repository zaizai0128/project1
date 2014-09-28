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
	protected $userInfo = Null;
	protected $costType = Null;	// 消耗的金币类型 1金币 2银币
	protected $vipBuy = null;		

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = D('User', 'Service');
		$this->userInfo = $this->userInstance->getAccountInfo(ZS('SESSION.user', 'user_id'));
		$this->costType = \Zlib\Api\Acl::cost($this->userInfo, $this->chapterInfo);
		$this->discountInstance = D('Discount', 'Service');
		$this->billInstance = D('Bill', 'Service');
		$this->vipBuy = new \Zlib\Api\UserVipBuy($this->userInfo['user_id'], $this->bookId);
	} 

	/**
	 * 执行购买流程
	 */
	public function doCost()
	{
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
		$bill['chapter'] = serialize(array('id'=>$this->chapterId,'name'=>$this->chapterInfo['ch_name']));
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
		// 记录到流水					
		$result['bill'] = $this->billInstance->doAdd($bill);				
			
		// 为用户添加购买后的权限
		$result['buy'] = $this->vipBuy->setBuyByOrder($this->chapterInfo['ch_order']);
		
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
}