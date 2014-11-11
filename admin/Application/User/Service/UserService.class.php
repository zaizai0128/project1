<?php
/**
 * 用户
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-11
 * @version 1.0
 */
namespace User\Service;
use \Zlib\Model\ZlibUserModel;

class UserService extends ZlibUserModel {

	public function resetPwd($data)
	{
		if (empty($data['password']))
			return z_ajax_info(-1, '密码不允许为空');
		if (strlen($data['password']) < 6)
			return z_ajax_info(-2, '密码最少6位');

		$res = parent::resetPwd($data);
		return $res ? z_ajax_info(1, '修改成功') : z_ajax_info(0, '修改失败') ;
	}


}