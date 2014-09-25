<?php
/**
 * 折扣 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-19
 * @version 1.0
 */
namespace Buy\Service;
use Zlib\Model\ZlibBookDiscountModel;

class DiscountService extends ZlibBookDiscountModel {

	/**
	 * 获取折扣信息
	 * @param int book_id
	 * @return int 返回折扣类型id 默认0
	 */
	public function getDiscountInfo($book_id)
	{
		$discount_info = parent::getDiscountInfo($book_id);

		if (empty($discount_info))
			return 0;

		$now = date('Y-m-d H:i:s', time());

		// 活动失效
		if ($discount_info['status'] != 1 || $now < $discount_info['discount_start'] 
			|| $now > $discount_info['discount_end'])
			return 0;

		// 返回对应折扣类型
		return $discount_info['bk_value_id'];
	}
}