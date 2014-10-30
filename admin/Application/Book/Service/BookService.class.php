<?php
/**
 * 作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Book\Service;
use Zlib\Model\ZlibBookModel;

class BookService extends ZlibBookModel {

	/**
	 * 修改作品信息
	 */
	public function doEditInfo($data)
	{
		$rs = parent::doEdit($data);
		
		if ($rs)
			return z_ajax_info(1, '修改成功');
		return z_ajax_info(0, '修改失败');
	}


}