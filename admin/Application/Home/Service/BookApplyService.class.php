<?php
/**
 * 申请作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibBookApplyModel;

class BookApplyService extends ZlibBookApplyModel {

	/**
	 * 审核
	 */
	public function doApplyBook($data)
	{
		$rs = parent::doEdit($data);	

		if ($rs)
			return z_ajax_return(1, '成功');
		else
			return z_ajax_return(0, '审核失败');
	}
	
}