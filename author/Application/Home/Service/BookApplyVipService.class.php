<?php
/**
 * 申请成为vip model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */

namespace Home\Service;
use Home\Model\BookApplyVipModel;

class BookApplyVipService extends BookApplyVipModel {

	/**
	 * override
	 */
	public function doAdd($data)
	{
		// 判断填充内容是否合格。。具体 待定

		$final_data = array();
		$final_data['bk_id'] = $data['bk_id'];
		$final_data['bk_name'] = $data['bk_name'];
		$final_data['bk_size'] = $data['bk_size'];
		$final_data['author_id'] = $data['bk_author_id'];
		$final_data['author_name'] = $data['bk_author'];
		$final_data['status'] = '00';
		$final_data['apply_comments'] = $data['apply_comments'];
		$final_data['create_time'] = date('Y-m-d H:i:s', time());

		$result = parent::doAdd($final_data);

		if ($result)
			return z_info(1, '提交成功');
		else
			return z_info(0, '提交失败'); 
	}
}