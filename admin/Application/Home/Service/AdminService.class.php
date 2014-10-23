<?php
/**
 * 管理员 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-20
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\BaseModel;

class AdminService extends BaseModel {

	/**
	 * 获取管理员信息
	 */
	public function getAdminInfo($user_id)
	{
		// tmp
		if (!$user_id) return null;


		$rs = ZS('SESSION.admin');
		return $rs;
	}

	/**
	 * 登录
	 */
	public function login($user)
	{	
		// 验证码
		if (!z_check_verify($user['verify']) )
			return z_ajax_return(-1, '验证码错误');

		// 管理员表未建，先用固定的数据做判断
		if ($user['user_name'] != 'admin' || $user['password'] != '123123')
			return z_ajax_return(-2, '用户名或密码错误');

		// tmp
		$user['user_id'] = 1;
		// 设置session
		ZS('SESSION.admin', Null, $user);
		return z_ajax_return(1, '登录成功');
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		ZS('SESSION.admin', Null, Null, -1);
		return z_ajax_return(1, '退出成功');
	}
}