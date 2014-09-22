<?php
/**
 * 申请成为vip zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookApplyVipModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply_vip';

	/**
	 * 获取数据
	 *
	 * @param int book_id
	 */
	public function getInfoByBookId($book_id)
	{
		return $this->where('bk_id = '.$book_id)->find();
	}

	/**
	 * 添加数据
	 */
	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 修改数据
	 */
	public function doEdit($data)
	{
		$condition = 'id = '.$data['id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 删除数据
	 */
	public function doDelete($data)
	{
		$condition = 'id = '.$data['id'];
		return $this->where($condition)->delete();
	}
	
}