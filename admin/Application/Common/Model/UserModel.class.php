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
use Zlib\Model\ZlibUserModel;

class UserModel extends Model {

	protected $trueTableName = 'admin_user';
	protected $userInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = new ZlibUserModel;
	}

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
		$data['user_login_time'] = z_now();
		$this->where($condition)->data($data)->save();

		$u_data['user_login_time'] = $data['user_login_time'];
		$u_data['user_login_ip'] = z_ip();
		return $this->userInstance->where($condition)->data($u_data)->save();
	}

}