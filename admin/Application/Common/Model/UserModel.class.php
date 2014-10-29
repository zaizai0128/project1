<?php
/**
 * 后台用户 model层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Common\Model;
use Think\Model;

class UserModel extends Model {

	protected $trueTableName = 'admin_user';

	/**
	 * 通过用户名获取用户信息
	 */
	public function getUserInfo($username, $field = '*')
	{
		$condition = 'user_name = "'.$username.'"';
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 通过id获取用户信息
	 */
	public function getUserInfoById($user_id, $field = '*')
	{
		$condition = 'user_id = '.$user_id;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 添加
	 */
	public function doAdd($data)
	{
		return $this->data($data)->add();
	}	

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		$condition = 'user_id = '.$data['user_id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 禁用
	 */
	public function setDeny($user_id)
	{	
		$condition = 'user_id = '.$user_id;
		$data['status'] = 0;
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 启用
	 */
	public function setNoDeny($user_id)
	{
		$condition = 'user_id = '.$user_id;
		$data['status'] = 1;
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 设置登录时间
	 */
	public function setLoginTime($user_id)
	{
		$condition = 'user_id = '.$user_id;
		$data['login_time'] = z_now();
		return $this->where($condition)->data($data)->save();
	}

}