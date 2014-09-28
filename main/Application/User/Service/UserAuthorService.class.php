<?php
/**
 * 作者 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace User\Service;
use Zlib\Model\ZlibUserAuthorModel;

class UserAuthorService extends ZlibUserAuthorModel {

	/**
	 * 编辑作者信息
	 *
	 * @param array
	 */
	public function doEdit($data)
	{
		// 一些验证 ...
		
		$final_data['user_id'] = $data['user_id'];
		$final_data['user_true_name'] = $data['name'];
		$final_data['user_zipcode'] = $data['zipcode'];
		$final_data['user_address'] = $data['address'];
		
		$result = parent::doEdit($final_data);

		if ($result > 0)
			return z_info(1, '修改成功');
		else
			return z_info(0, '修改失败');
	}

	/**
	 * 判断是否需要补充个人信息
	 *
	 * @param int user_id
	 */
	public function checkUserAuthorInfo($user_id)
	{
		$authorInfo = parent::getAuthorInfoByUserId($user_id, 'user_id');

		if (empty($authorInfo))
			return z_info(-1, '个人真实信息不存在');
		return z_info(1, '验证通过');
	}

}