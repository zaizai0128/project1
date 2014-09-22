<?php
/**
 * 申请作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\BookModel;

class BookService extends BookModel {

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		
	}

	/**
	 * 编辑签约状态
	 */
	public function doEditCommision($data)
	{
		$final_data['bk_id'] = $data['bk_id'];
		$final_data['bk_commision'] = $data['bk_commision'];
		return parent::doEdit($final_data);
	}
	
}