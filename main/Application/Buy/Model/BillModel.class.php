<?php
/**
 * 流水账单 model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-19
 * @version 1.0
 */
namespace Buy\Model;
use Zlib\Model\BaseModel;

class BillModel extends BaseModel {

	protected $billObj = Null;	//数据库对象
	protected $billPrefix = 'zl_bill_'; // 表前缀
	protected $tableName = Null;	// 表名
	

	/**
	 * 添加流水账单
	 */
	public function doAdd($bill)
	{
		return $this->billObj->data($bill)->add();
	}
}