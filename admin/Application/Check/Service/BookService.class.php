<?php
/**
 * 申请作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Check\Service;
use Zlib\Model\ZlibBookModel;

class BookService extends ZlibBookModel {

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