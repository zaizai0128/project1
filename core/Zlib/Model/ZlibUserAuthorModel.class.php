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
	protected $userInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = new ZlibUserModel;
	}

	/**
	 * 获取列表总数
	 * @param array 条件
	 */
	public function getTotal($where = null)
	{
		$condition['u.user_type'] = '02';
		$condition = array_merge($condition, (array)$where);
		$condition = z_array_filter($condition, false);

		return $this->alias('AS a')
				   ->join('LEFT JOIN zl_user AS u ON a.user_id = u.user_id')
				   ->where($condition)->count();
	}

	/**
	 * 获取列表
	 */
	public function getList($where = null, $page = null, $field = '*')
	{
		$condition['u.user_type'] = '02';
		$condition = array_merge($condition, (array)$where);
		$condition = z_array_filter($condition, false);
		
		if ($page)
			return $this->alias('AS a')
					->join('LEFT JOIN zl_user AS u ON a.user_id = u.user_id')
					->where($condition)
					->limit($page['firstRow'], $page['listRows'])->order('u.user_id desc')->select();
		else
			return $this->alias('AS a')
					->join('LEFT JOIN zl_user AS u ON a.user_id = u.user_id')
					->where($condition)->order('u.user_id desc')->select();
	}
	
	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		return $this->where('user_id = '.$data['user_id'])->data($data)->save();
	}

	public function doAdd($data)
	{
		return $this->data($data)->add();
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

	/**
	 * 获取作者全部信息
	 */
	public function getAuthorAllInfoByUserId($user_id, $field='*')
	{
		$condition['a.user_id'] = $user_id;
		$field .= ',u.user_name as user_name';	// tmp 由于bank没有user_name，导致为null
		
		return $this->alias('AS a')->field($field)
			->join('LEFT JOIN zl_user AS u ON a.user_id = u.user_id')
			->join('LEFT JOIN zl_user_author_bank AS b ON a.user_id = b.user_id')
			->where($condition)->find();
	}

	/**
	 * 获取编辑用户名
	 * @param int user_id
	 */
	public function getEditorNameByUserId($user_id)
	{
		$info = $this->userInstance->getUserInfoByUserId($user_id, 'user_name');
		return $info['user_name'];
	}

	/**
	 * 获取编辑信息
	 * @param string user_name
	 */
	public function getEditorByUserName($user_name, $field='*')
	{
		$info = $this->userInstance->getUserInfoByUserName($user_name, $field);
		return $info;
	}

	/**
	 * 获取作者的银行信息
	 */
	public function getBankByUserId($user_id, $field='*')
	{
		$bank = new ZlibUserAuthorBankModel;
		return $bank->getBankInfoByUserId($user_id, $field);
	}


}