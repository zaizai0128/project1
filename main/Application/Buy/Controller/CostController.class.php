<?php
/**
 * cost操作
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Buy\Controller;
use Zlib\Api as Zapi;

class CostController extends BuyController {

	protected $billObj = Null;
	protected $cost_obj = Null;
	protected $discount_obj = Null;
	protected $user_obj = Null;
	protected $user_info = Null;
	protected $user_id = Null;
	protected $cost_type = Null;	// 消耗的金币类型 1金币 2银币
	protected $vipBuy = null;		

	protected function init()
	{
		parent::init();
		$this->checkUserAcl();		// 检测用户购买的权限
		$this->cost_obj = D('Cost', 'Service');
		$this->discount_obj = D('Discount', 'Service');
		$this->billObj = D('Bill', 'Service');
	} 

	/**
	 * 执行购买流程
	 */
	public function doCost()
	{
		// 查询本书的活动
		$discount_type = $this->discount_obj->getDiscountInfo($this->book_id);
		$price = $this->chapter_info['ch_price'];
			
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
		if ($this->cost_type == 1) {
			$result['accounts'] = $db->table('zl_accounts')->where('oid = '.$this->user_id)
			->setDec('amount', $price);
		// 银币
		} else if ($this->cost_type == 2) {
			$result['accounts'] = $db->table('zl_accounts')->where('oid = '.$this->user_id)
			->setDec('bonus', $price);
		}
		
		// 记录到流水
		$bill = array();
		$bill['user_id'] = $this->user_id;
		$bill['user_name'] = $this->user_info['user_name'];
		$bill['user_type'] = $this->user_info['user_type'];
		$bill['bk_id'] = $this->book_id;
		$bill['chapter'] = serialize(array('id'=>$this->chapter_id,'name'=>$this->chapter_info['ch_name']));
		$bill['author_id'] = $this->book_info['bk_author_id'];
		$bill['author_name'] = $this->book_info['bk_author'];
		$bill['pay_money'] = $price;
		$bill['pay_type'] = $this->cost_type;
		$bill['buy_num'] = 1;
		$bill['buy_type'] = 1;
		$bill['discount_type'] = $discount_type; // 折扣类型
		$bill['time'] = date('Y-m-d H:i:s', time());
		$bill['status'] = 1;
		$bill['detail'] = $this->user_info['user_name'].'购买'.$this->book_info['bk_author'].'写的《'
							.$this->book_info['bk_name'].'》作品的《'.$this->chapter_info['ch_name'].'》，很是开心。';					
		// 记录到流水					
		$result['bill'] = $this->billObj->doAdd($bill);				
			
		// 为用户添加购买后的权限
		$result['buy'] = $this->vipBuy->setBuyByOrder($this->chapter_info['ch_order']);

		// 如果购买成功
		if (array_product($result) >= 1)
		{
			$db->commit();
			$this->success('购买成功', ZU('read/index', 'ZL_BOOK_DOMAIN', 
							array('book_id'=>$this->book_id, 'ch_id'=>$this->chapter_id)));
		} else {
			$db->rollback();
			// 记录到error_log中
			$this->error('购买失败，请重新尝试');
		}
	}
}