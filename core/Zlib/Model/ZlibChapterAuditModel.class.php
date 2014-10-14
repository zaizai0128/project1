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


}