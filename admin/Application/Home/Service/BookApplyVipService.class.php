<?php
/**
 * 申请成为vip model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */

namespace Home\Service;
use Zlib\Model\ZlibBookApplyVipModel;

class BookApplyVipService extends ZlibBookApplyVipModel {

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		$final_data = array();
		$final_data['id'] = $data['id'];
		$final_data['action_user'] = $data['user_id'];
		$final_data['action_name'] = $data['user_name'];
		$final_data['action_comments'] = $data['action_comments'];
		$final_data['status'] = $data['status'];
		$final_data['bk_commision'] = $data['bk_commision'];
		$final_data['time'] = z_now();

		$result = parent::doEdit($final_data);

		if ($result)
			return z_ajax_return(1, '修改成功');
		else
			return z_ajax_return(0, '修改失败');
	}
}