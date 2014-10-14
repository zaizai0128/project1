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
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id'.$data['ch_id'];
		return $this->where($condition)->data($data)->save();
	}



}