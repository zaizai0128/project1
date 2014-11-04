<?php
/**
 * 审核 model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-31
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibAuditModel extends BaseModel {

	protected $trueTableName = 'zl_audit';
	protected $type = Null;

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	public function doEdit($data)
	{
		$condition['id'] = $data['id'];
		$condition['audit_type'] = $this->type;
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 获取列表总数
	 */
	public function getTotal($where = null)
	{	
		$condition['status'] = 0;
		$condition['audit_type'] = $this->type;
		$condition = array_merge($condition, (array)$where);
		$condition = z_array_filter($condition, false);
		return $this->where($condition)->count();
	}

	/**
	 * 获取列表
	 */
	public function getList($where = null, $page = null)
	{
		$condition['status'] = 0;
		$condition['audit_type'] = $this->type;
		$condition = array_merge($condition, (array)$where);
		$condition = z_array_filter($condition, false);

		if (!empty($page))
			return $this->where($condition)->limit($page['firstRow'], $page['listRows'])->select();
		else
			return $this->where($condition)->select();
	}

	/**
	 * 获取信息
	 */
	public function getInfo($id, $field='*')
	{
		$condition['id'] = $id;
		$condition['audit_type'] = $this->type;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 审核设置通过
	 */
	public function setAllow($id)
	{
		$condition = 'id = '.$id;
		$data['status'] = 1;
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 审核设置拒绝
	 */
	public function setDeny($id)
	{
		$condition = 'id = '.$id;
		$data['status'] = 2;
		return $this->where($condition)->data($data)->save();
	}
}