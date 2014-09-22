<?php
/**
 * vip章节 service
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\ChapterVipModel;

class ChapterVipService extends ChapterVipModel {

	/**
	 * override
	 * @param Array 
	 */
	public function doAdd($data)
	{
		$final_data = array();
		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_id'] = $data['ch_id'];
		$final_data['ch_name'] = $data['ch_name'];
		$final_data['ch_content'] = $data['ch_content'];
		
		return parent::doAdd($final_data);
	}

}