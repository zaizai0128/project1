<?php
/**
 * 作品的活动 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-25
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookDiscountModel extends BaseModel {

	protected $trueTableName = 'zl_book_discount';

	/**
	 * 获取作品的折扣信息
	 * @param int book_id
	 * @param String field 
	 */
	public function getDiscountInfo($book_id, $field='*')
	{
		$condition = 'bk_id = '.$book_id.' and status = 1';
		return $this->field($field)->where($condition)->find();
	}

}