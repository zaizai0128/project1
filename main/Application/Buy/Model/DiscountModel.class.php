<?php
/**
 * 折扣 model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-19
 * @version 1.0
 */
namespace Buy\Model;
use Zlib\Model\BaseModel;

class DiscountModel extends BaseModel {

	protected $trueTableName = 'zl_book_discount';

	/**
	 * 获取某本书的折扣信息
	 */
	public function getDiscountInfo($book_id)
	{
		return $this->where('bk_id = '.$book_id.' and status = 1')->find();
	}
}