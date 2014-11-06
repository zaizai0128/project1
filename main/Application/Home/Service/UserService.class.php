<?php
/**
 * 用户 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibUserModel;

class UserService extends ZlibUserModel {

	/**
	 * 用户登录
	 */
	public function doLogin($data)
	{
		if (empty($data['username'])) return z_info(-1, '用户名不允许为空');
		if (empty($data['password'])) return z_info(-2, '密码不允许为空');
		
		// 通过用户名查找用户信息
		$user_info = parent::getUserInfoByUserName($data['username']);

		if (empty($user_info)) 
			return z_info(-3, '用户不存在');
		if ($user_info['user_state'] == 1) 
			return z_info(-4, '该用户已被禁用');
		if ($user_info['user_state'] == 'N')
			return z_info(-5, '用户未被激活');

		$data['password'] = strlen($data['password']) == '32' ? $data['password'] : md5($data['password']) ;
		if ($user_info['user_pwd'] != $data['password'])
			return z_info(-5, '密码不正确');

		// 销毁密码
		unset($user_info['user_pwd']);

		// 登录成功 .. 设置一些操作

		// 保存session
		ZS('SESSION.user', Null, $user_info);

		// 更新用户最后登录信息
		$final_data['user_id'] = $user_info['user_id'];
		$final_data['user_login_time'] = z_now();
		$final_data['user_login_ip'] = z_ip();
		parent::doEdit($final_data);

		return z_info(1, '登录成功');
	}

	/**
	 * 个性化添加用户
	 */
	public function doAdd($data)
	{
		if (!z_check_verify($data['verify']) )
			return z_info(-1, '验证码错误');

		if (empty($data['username']))
			return z_info(-2, '用户名不允许为空');

		if (empty($data['password']))
			return z_info(-21, '密码不允许为空');

		// ... 更多的二次验证，后期开发
		
		$final_data['user_name'] = $data['username'];
		$final_data['user_pwd'] = md5($data['password']);
		$final_data['reg_type'] = 0;		// 个性化注册为0
		$final_data['user_state'] = 0;
		$final_data['user_type'] = '00';
		$final_data['user_join'] = z_now();
		$final_data['user_login_time'] = z_now();
		$final_data['user_login_ip'] = z_ip();

		$user_id = parent::doAdd($final_data);

		if ($user_id) {
			
			$final_data['user_id'] = $user_id;
			z_tag('user', 'after_add', $final_data);

			return z_info($user_id, '添加成功');
		} else {
			return z_info(0, '添加失败');
		}
	}

	/**
	 * 邮箱注册
	 */
	public function doAddByEmail($data)
	{
		if (empty($data['email']))
			return z_info(-2, '用户名不允许为空');

		if (empty($data['password']))
			return z_info(-21, '密码不允许为空');

		$final_data['user_name'] = $data['email'];
		$final_data['user_email'] = $data['email'];
		$final_data['user_pwd'] = md5($data['password']);
		$final_data['reg_type'] = 2;			// 邮箱注册用户 2
		$final_data['user_state'] = 'N';		// 未激活用户
		$final_data['user_type'] = '00';		
		$final_data['user_join'] = z_now();
		$final_data['user_login_time'] = z_now();
		$final_data['user_login_ip'] = z_ip();

		$user_id = parent::doAdd($final_data);

		if ($user_id) {

			$final_data['user_id'] = $user_id;
			z_tag('user', 'after_add', $final_data);

			return z_info($user_id, '添加成功');
		} else {
			return z_info(0, '添加失败');
		}
	}

	/**
	 * 用户退出
	 */
	public function logout()
	{
		ZS('SESSION.user', Null, Null, -1);
		return True;
	}

}