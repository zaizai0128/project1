<?php
/**
 * 打赏 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace App\Service;
use Zlib\Model\BaseModel;
use Zlib\Model\ZlibAccountsModel;
use Zlib\Model\ZlibBillModel;

class RewardService extends BaseModel {

	const LOG_TYPE = 'A'; // 流水日志类型为A
	protected $userAccountInstance = Null;
	protected $billInstance = Null;
	protected $flowerInstance = Null;
	protected $orderCode = Null;	// 订单号

	protected function init()
	{
		parent::init();
		$this->userAccountInstance = new ZlibAccountsModel;
		$this->billInstance = new ZlibBillModel;
		$this->flowerInstance = D('Flower', 'Service');
		$this->orderCode = date('YmdHis', time()) . mt_rand(100000, 999999);
	}

	/**
	 * 进行打赏操作
	 */
	public function addReward($data)
	{
		$state = $this->_check($data);		
		if ($state['code'] < 0) return $state;

		$result = array();
		// 开启事务
		$this->startTrans();

		// 用户减去对应的逐浪币 accounts表
		$account_data['num'] = (int)$data['num'];
		$account_data['user_id'] = $data['user_info']['user_id'];
		$result['account'] = $this->userAccountInstance->reduceAccount($account_data);

		// 添加到消费日志中 bill
		$log_data['user_id'] = $data['user_info']['user_id'];
		$log_data['user_name'] = $data['user_info']['user_name'];
		$log_data['user_type'] = $data['user_info']['user_type'];
		$log_data['bk_id'] = $data['book_info']['bk_id'];
		$log_data['bk_name'] = $data['book_info']['bk_name'];
		$log_data['chapter'] = '';
		$log_data['author_id'] = $data['book_info']['bk_author_id'];
		$log_data['author_name'] = $data['book_info']['bk_author'];
		$log_data['pay_money'] = $data['num'];
		$log_data['money_type'] = 1;	// 逐浪金币
		$log_data['buy_num'] = 1;
		$log_data['buy_type'] = self::LOG_TYPE;
		$log_data['discount_type'] = '';
		$log_data['time'] = z_now();
		$log_data['detail'] = $data['user_info']['user_name'].'大发善心，打赏了'
							.$data['book_info']['bk_author'].'的作品《'.$data['book_info']['bk_name'].'》'
							.$data['num'].'个逐浪币';
		$log_data['from_ch_order'] = time();
		$log_data['order_id'] = $this->orderCode;
		$result['log'] = $this->billInstance->doAdd($log_data);

		// 消费赠送鲜花
		$result['flower'] = $this->_costAddFlower($data);
		
		// 如果全部都成功，commit
		if (array_product($result) >= 1) {
			$this->commit();
			return z_info(1, '打赏成功');

		} else {
			$this->rollback();
			return z_info(0, '打赏失败，请重新尝试');
		}
	}

	/**
	 * 消费赠送鲜花
	 */
	private function _costAddFlower($data)
	{
		// 获取当月消费总额
		$month_cost_total = $this->billInstance->getCostSum($data['user_info']['user_id']);
		// 获取当月用户的鲜花总数
		$flower_have_total = $this->flowerInstance->getFlowerSum($data['user_info']['user_id']);
		// 获取应该赠送的鲜花数
		$add_flower_num = $this->flowerInstance->getAddFlowerNum($month_cost_total, $flower_have_total);

		$flower['num'] = $add_flower_num;
		$flower['total_num'] = $flower_have_total;
		$flower['user_id'] = $data['user_info']['user_id'];
		return $this->flowerInstance->costAddFlower($flower);
	}

	private function _check($data)
	{
		$maxNum = $data['user_info']['amount'];
		$minNum = C('APP.min_reward_num');
		$num = $data['num'];

		if ($num > $maxNum) {
			return z_info(-1, '您的余额不足');
		} else if ($num < $minNum) {
			return z_info(-2, '最低不允许小于'.$minNum.'逐浪币');
		}
		return z_info(1, '验证通过');
	}
	
}