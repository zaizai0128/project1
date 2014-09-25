<?php
/**
 * 用户 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibUserModel extends BaseModel {

	protected $trueTableName = 'zl_user';
	protected $userAuthorApplyInstance = Null;	// 用户请求数据对象

	public function init()
	{
		parent::init();
		$this->userAuthorApplyInstance = M('ZlUserAuthorApply');
	}

	/**
	 * 获取用户全部信息
	 *
	 * @param int user_id
	 */
	public function getUserFullInfoByUserId($user_id)
	{
		// 用户基础信息
		$user_info = $this->getUserInfoByUserId($user_id);
		// 用户作者信息
		$user_author = new ZlibUserAuthorModel;
		$author_info = $user_author->getAuthorInfoByUserId($user_id);
		return array_merge($user_info, $author_info);
	}

	/**
	 * 通过用户id获取该用户申请作者的信息
	 * 
	 * @param int user_id
	 * @param String field
	 */
	public function getApplyInfoByUserId($user_id, $field='*')
	{
		$condition = 'user_id = '.$user_id;
		return $this->userAuthorApplyInstance->field($field)->where($condition)->find();
	}

	/**
	 * 通过用户名获取用户信息
	 *
	 * @param string username
	 * @param string field '*'
	 * @param string where
	 */
	public function getUserInfoByUserName($username, $field = '*', $where = '')
	{
		$condition = 'user_name = "'.$username.'"';
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 通过用户id获取用户信息
	 *
	 * @param string user_id
	 * @param string field '*'
	 * @param string where
	 */
	public function getUserInfoByUserId($user_id, $field = '*', $where = '')
	{
		$condition = 'user_id = '.$user_id;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 添加
	 *
	 * @param array
	 */
	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 添加用户申请作者信息
	 */
	public function doAddApply($data)
	{
		return $this->userAuthorApplyInstance->data($data)->add();
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
	 * 用户退出
	 */
	public function logout()
	{
		// 待操作 ...
		return True;
	}
}