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

		$rs = ZS('SESSION.admin');
		$rs['user_id'] = 1;
		return $rs;
	}

	/**
	 * 登录
	 */
	public function login($user)
	{	
		// 验证码
		if (!z_check_verify($user['verify']) )
			return z_info(-1, '验证码错误');

		// 管理员表未建，先用固定的数据做判断
		if ($user['user_name'] != 'admin' || $user['password'] != '123123')
			return z_info(-1, '用户名或密码错误');

		// 设置session
		ZS('SESSION.admin', Null, $user);
		$rs = z_info(1, '登录成功');
		$rs['url'] = ZU('index/index', 'ZL_ADMIN_DOMAIN');

		return $rs;
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		ZS('SESSION.admin', Null, Null, -1);
		return z_info(1, '退出成功');
	}
}