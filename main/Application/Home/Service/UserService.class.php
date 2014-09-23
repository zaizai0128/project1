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
		// 个性化注册为0
		$final_data['reg_type'] = 0;
		$final_data['user_state'] = 0;
		$final_data['user_type'] = '00';
		$final_data['user_join'] = z_now();

		$user_id = parent::doAdd($final_data);

		if ($user_id) {
			return z_info(1, '添加成功');
		}
	}

}