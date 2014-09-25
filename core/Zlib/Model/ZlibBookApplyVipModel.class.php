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
	 * @param String field
	 */
	public function getInfoByBookId($book_id, $field='*')
	{
		return $this->field($field)->where('bk_id = '.$book_id)->find();
	}

	/**
	 * 获取总数
	 *
	 * @param array 条件数组
	 */
	public function getTotal($where = Null)
	{
		$condition = 'status = "00"';
		return $this->where($condition)->count();
	}

	/**
	 * 获取列表
	 *
	 * @param int Page->firstRow
	 * @param int Page->listsRows
	 * @param array 条件数组
	 */
	public function getList($firstRow = 0, $listsRows = 10, $where = Null)
	{
		$condition = 'status = "00"';
		$order = 'id desc';
		return $this->where($condition)->order($order)->limit($firstRow, $listsRows)->select();
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