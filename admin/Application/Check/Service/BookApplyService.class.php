<?php
/**
 * 申请作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Check\Service;
use Zlib\Model\ZlibBookApplyModel;

class BookApplyService extends ZlibBookApplyModel {

	/**
	 * 审核通过
	 */
	public function doCheckApplyBook($data)
	{
		$rs = parent::doEdit($data);

		if ($rs)
			return z_ajax_info(1, '审核完成');
		else
			return z_ajax_info(0, '审核失败');
	}
	
}