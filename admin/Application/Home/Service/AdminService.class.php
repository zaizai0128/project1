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
	 * 注册
	 */
	public function doRegister($data)
	{
		$user_name = $data['user_name'];
		$user_info = $this->userInstance->getUserInfoByUserName($user_name, 'user_id');

		if (!empty($user_info))
			return z_ajax_info(-1, '用户已存在');

		if (empty($data['password'])) 
			return z_ajax_info(-2, '密码不允许为空');

		if (empty($data['nickname']))
			return z_ajax_info(-3, '昵称不允许为空');

		$user_info = $this->userInstance->getUserInfoByNickName($data['nickname'], 'user_id');

		if (!empty($user_info))
			return z_ajax_info(-11, '昵称已存在');

		// 前台用户的信息
		$user_data['user_name'] = $user_name;
		$user_data['user_pwd'] = strlen($data['password']) == 32 ? $data['password'] : md5($data['password']);
		$user_data['reg_type'] = 0;
		$user_data['user_type'] = '04';
		$user_data['user_join'] = z_now();
		$user_data['user_nickname'] = $data['nickname'];

		$id = $this->userInstance->doAdd($user_data);

		if (!$id)
			return z_ajax_info(0, '添加管理员失败');

		$admin_data['user_id'] = $id;
		$admin_data['user_name'] = $user_data['user_name'];
		$admin_data['user_pwd'] = $user_data['user_pwd'];
		// 临时
		$admin_data['gid'] = 1;
		$admin_data['user_join'] = $user_data['user_join'];
		$rs = parent::doAdd($admin_data);

		if ($rs)
			return z_ajax_info(1, '添加管理员成功');
		else
			return z_ajax_info(0, '添加管理员失败');
	}

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

		if ($user_info['user_pwd'] != md5($user['password']))
			return z_ajax_info(-21, '密码不正确');

		if ($user_info['status'] != 1)
			return z_ajax_info(-22, '该用户已被禁用');

		// 设置登录时间
		parent::setLoginTime($user_info['user_id']);

		// 获取前台用户表信息，获取后，保存到session中
		$user_info = $this->userInstance->getUserFullInfoByUserId($user_info['user_id']);
		unset($user_info['user_pwd']);

		// 设置session
		ZS('SESSION.admin', Null, $user_info);
		ZS('SESSION.user', Null, $user_info);

		return z_ajax_info(1, '登录成功');
	}

	/**
	 * 获取用户信息
	 */
	public function getUserFullInfoByUserId($user_id, $field="*")
	{
		return $this->userInstance->getUserFullInfoByUserId($user_id, $field);
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		ZS('SESSION.admin', Null, Null, -1);
		ZS('SESSION.user', Null, Null, -1);
		return z_ajax_info(1, '退出成功');
	}
}