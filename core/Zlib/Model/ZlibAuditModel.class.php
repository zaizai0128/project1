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
		$condition = 'id = '.$data['id'];
		return $this->where($condition)->data($data)->save();
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