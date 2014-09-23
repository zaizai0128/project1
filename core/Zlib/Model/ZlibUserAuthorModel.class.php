<?php
/**
 * 作者信息 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibUserAuthorModel extends BaseModel {

	protected $trueTableName = 'zl_user_author';
	protected $userAuthorBankInstance = Null;	// 用户银行数据对象

	public function init()
	{
		parent::init();
		$this->userAuthorBankInstance = M('ZlUserAuthorBank');
	}

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		return $this->data($data)->add($data, array(), True);
	}

	/**
	 * 通过用户id获取作者信息
	 *
	 * @param string user_id
	 * @param string field '*'
	 * @param string where
	 */
	public function getAuthorInfoByUserId($user_id, $field = '*', $where = '')
	{
		$condition = 'user_id = '.$user_id;
		return $this->field($field)->where($condition)->find();
	}

}