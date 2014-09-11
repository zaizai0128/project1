<?php
/**
 * 作品申请model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookApplyModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply';

	/**
	 * 创建一个作品申请
	 *
	 * @param Array 申请信息
	 */
	public function doAdd($book_info)
	{
		$book_info['bk_cre_time'] = date('Y-m-d H:i:s', time());
		return $this->data($book_info)->add();
	}
	
}