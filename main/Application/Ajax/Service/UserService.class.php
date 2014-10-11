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

		if (!empty($user)) return z_info(-1, '用户名已存在'); 

		return z_info(1, '验证通过');
	}

	/**
	 * 判断邮箱是否可用
	 */
	public function checkEmail($email)
	{
		$email_role = '/\w+@\w{2,}\.(com|cn|net|me|com\.cn)$/';
		// 正则匹配是否是邮箱
		$result = preg_match($email_role, $email);

		if ($result <= 0) return z_info(-1, '邮箱格式不正确');

		$user = $this->getUserInfoByUserName($email, 'user_id');

		if (!empty($user)) return z_info(-2, '用户名已存在');
		
		return z_info(1, '验证通过');
	}

}