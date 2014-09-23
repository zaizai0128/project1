<?php
/**
 * 用户 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Ajax\Service;
use Zlib\Model\ZlibUserModel;

class UserService extends ZlibUserModel {

	/**
	 * 判断用户名是否可用
	 * @param string username
	 */
	public function checkUsername($username)
	{
		// 判断用户名是否含有非法字符等...

		// 判断用户名是否已存在
		$user = $this->getUserInfoByUserName($username, 'user_id');

		if (!empty($user)) return array('code'=>-1, 'msg'=>'用户名已存在'); 

		return array('code'=>1, 'msg'=>'验证通过');
	}

}