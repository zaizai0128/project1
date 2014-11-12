<?php
/**
 * 作者表 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-10
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibUserAuthorModel;

class UserAuthorService extends ZlibUserAuthorModel {

	/**
	 * 保存作者信息
	 */
	public function doAddInfo($data)
	{	
		// 一些验证信息 ...
		
		$final_author['user_id'] = $data['user_id'];
		$final_author['user_zipcode'] = $data['a_zipcode'];
		$final_author['user_address'] = $data['a_address'];
		$final_author['user_idcard'] = $data['a_idcard'];
		// $final_author['shenhe_time'] = z_now();

		$result = parent::getAuthorInfoByUserId($data['user_id'], 'user_id');

		if (empty($result)) {
			$result = parent::doAdd($final_author);
		} else {
			$result = parent::doEdit($final_author);
		}

		if ($result)
			return z_info(1, '修改成功');
		else
			return z_info(0, '修改失败');
	}	
}