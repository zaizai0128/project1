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

	/**
	 * 通过用户名获取用户信息
	 *
	 * @param string username
	 * @param string field '*'
	 * @param string where
	 */
	public function getUserInfoByUsername($username, $filed = '*', $where = '')
	{
		$condition = 'user_name = "'.$username.'"';
		return $this->field('*')->where($condition)->find();
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
}