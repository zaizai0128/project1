<?php
/**
 * vip章节 service
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibChapterVipModel;

class ChapterVipService extends ZlibChapterVipModel {

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		$final_data['ch_name'] = $data['ch_name'];
		$final_data['ch_content'] = $data['content'];
		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_id'] = $data['ch_id'];
		
		return parent::doEdit($final_data);
	}

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
		$final_data['ch_content'] = $data['content'];
		
		return parent::doAdd($final_data);
	}

}