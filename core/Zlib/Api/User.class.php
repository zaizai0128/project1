<?php
/**
 * 公共的用户api接口
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.1
 */
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class User extends Zmodel\BaseModel {

	protected $trueTableName = 'zl_user';

	/**
	 * 通过用户名获取用户id
	 *
	 * @param String  $username
	 * @return Boolean / Int
	 */
	public function getIdByUsername($username)
	{
		$r = $this->field('user_id')->where('user_name = "'.$username.'"')->find();
		return empty($r) ? $r : $r['user_id'] ;
	}

	/**
	 * 注册
	 *
	 * @param 	String 	用户名
	 * @param 	String  密码
	 * @return 	int 	注册后的id
	 */
	public function register($username, $password)
	{
		if (strlen($password) != 32) 
			$password = md5($password);

		$data['user_name'] = $username;
		$data['user_pwd'] = $password;
		$data['user_join'] = date('Y-m-d H:i:s');
		return $this->data($data)->add();
	}

	/**
	 * 登录
	 *
	 * @param 	String 	用户名
	 * @param 	String  密码
	 */
	public function login($username, $password)
	{
		if (empty($username)) {
			return array('code'=>-1 , 'msg'=>'用户名不允许为空');
		}

		// 通过用户名获取uid
		$uid = $this->getIdByUsername($username);

		if (!$uid) {
			return array('code'=>-3, 'msg'=>'用户不存在');
		}

		// 获取用户信息
		$info = $this->getInfo($uid);

		if ($info['user_pwd'] != md5($password)) {
			return array('code'=>-4, 'msg'=>'用户密码不正确');
		}

		unset($info['user_pwd']);
		$info['code'] = 1;
		$info['msg']  = '验证通过';
		session('user', $info);
		
		return $info;
	}

	/**
	 * 退出
	 *
	 * @return boolean 
	 */
	public function logout()
	{
		session('user', Null);
		return True;
	}


	/**
	 * 获取用户信息
	 *
	 * @param  uid 	 用户id
	 * @param  Boolean 是否获取全部信息
	 * @return array 用户信息
	 */
	public function getInfo($uid, $full = False)
	{
		$base_info = $this->where('user_id = '.$uid)->find();
				
		return $base_info;
	}

	/**
	 * 检测用户名是否可用
	 *
	 * @param  String 用户名
	 * @return array  状态值 和 状态信息
	 */
	public function checkUsername($username)
	{
		if (empty($username)) {
			return array('code'=>-1, 'msg'=>'用户名不允许为空');
		}

		// 通过用户名获取uid
		$uid = $this->getIdByUsername($username);

		if ($uid > 0) {
			return array('code'=>-2, 'msg'=>'用户名已存在');
		}

		return array('code'=>1, 'msg'=>'验证通过');
	}

	/**
	 * 检测用户密码
	 *
	 * @param String 密码
	 * @param String 重复密码
	 */
	public function checkPassword($password, $re_password)
	{	
		if (empty($password)) {
			return array('code'=>-11, 'msg'=>'密码不允许为空');
		}

		if ($password !== $re_password)  {
			return array('code'=>-12, 'msg'=>'二次密码不一致');
		}

		return array('code'=>1, 'msg'=>'验证通过');
	}

	/**
	 * 更新用户扩展信息
	 * 
	 * @param 	array 	用户扩展信息
	 */
	public function updateExt($user)
	{
		// 如果用户id不存在，则返回False
		if (!isset($user['user_id'])) {
			return array('code'=>-1, 'msg'=>'用户主键为空');
		}

		$state = $this->save($user);
		return $state > 0 ? array('code'=>1, 'msg'=>'修改成功') : array('code'=>-1, 'msg'=>'内容未修改或修改失败');
	}
}