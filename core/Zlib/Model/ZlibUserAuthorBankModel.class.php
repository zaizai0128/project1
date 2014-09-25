<?php
/**
 * 用户银行信息 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibUserAuthorBankModel extends BaseModel {

	protected $trueTableName = 'zl_user_author_bank';

	/**
	 * 获取作者的银行信息
	 *
	 * @param int user_id
	 */
	public function getBankInfoByUserId($user_id, $field='*', $where='')
	{
		$condition = 'user_id = '.$user_id.$where;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 保存作者的银行信息
	 */
	public function doAddBank($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 修改作者的银行信息
	 */
	public function doEditBank($data)
	{
		$condition = 'id = '.$data['id'].' and user_id = '.$data['user_id'];
		return $this->data($data)->save();
	}
}