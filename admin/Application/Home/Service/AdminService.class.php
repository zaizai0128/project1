<?php
/**
 * 管理员 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-20
 * @version 1.0
 */
namespace Home\Service;
use Common\Model\UserModel;

class AdminService extends UserModel {

	/**
	 * 登录
	 */
	public function login($user)
	{	
		// 验证码
		if (!z_check_verify($user['verify']) )
			return z_ajax_info(-1, '验证码错误');

		// 获取用户信息
		$user_info = parent::getUserInfo($user['user_name']);

		if (empty($user_info))
			return z_ajax_info(-2, '用户不存在');

		if ($user_info['password'] != md5($user['password']))
			return z_ajax_info(-21, '密码不正确');

		if ($user_info['status'] != 1)
			return z_ajax_info(-22, '该用户已被禁用');

		unset($user_info['password']);

		// 设置登录时间
		parent::setLoginTime($user_info['user_id']);

		// 设置session
		ZS('SESSION.admin', Null, $user_info);
		return z_ajax_info(1, '登录成功');
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		ZS('SESSION.admin', Null, Null, -1);
		return z_ajax_info(1, '退出成功');
	}
}