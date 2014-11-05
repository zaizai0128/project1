<?php
/**
 * 章节审核 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-14
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibChapterAuditModel extends BaseModel {

	protected $trueTableName = 'zl_chapter_audit';

	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	public function doEdit($data)
	{
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id = '.$data['ch_id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 获取待审核信息
	 *
	 * @param int book_id
	 * @param int chapter_id
	 * @param string field
	 */
	public function getNotCheckInfo($book_id, $chapter_id, $filed='*')
	{
		$condition = 'bk_id = '.$book_id.' and ch_id = '.$chapter_id.' and status = 0';
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 获取审核信息
	 * @param int id
	 * @param string field
	 */
	public function getCheckInfo($id, $field='*', $where=null)
	{
		$condition['id'] = $id;
		$condition['status'] = 0;
		$condition = array_merge($condition, (array)$where);
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 获取列表总数
	 * @param array 条件
	 */
	public function getTotal($where = null)
	{
		$condition['status'] = 0;
		$condition = array_merge($condition, (array)$where);
		$condition = z_array_filter($condition, false);

		return $this->where($condition)->count();
	}

	/**
	 * 获取列表
	 */
	public function getList($where = null, $page = null, $field = '*')
	{
		$condition['status'] = 0;
		$condition = array_merge($condition, (array)$where);
		$condition = z_array_filter($condition, false);
		
		if ($page)
			return $this->field($field)->where($condition)
						->limit($page['firstRow'], $page['listRows'])->order('id desc')->select();
		else
			return $this->field($field)->where($condition)->order('id desc')->select();
	}

}