<?php
/**
 * 申请作品章节model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookApplyChapterModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply_chapter';

	/**
	 * 为申请作品添加章节
	 * 
	 * @param Array 章节信息
	 */
	public function doAdd($data)
	{
		$data['ch_cre_time'] = date('Y-m-d H:i:s', time());
		$data['ch_update'] = date('Y-m-d H:i:s', time());
		$data['ch_size'] = mb_strlen($data['ch_content']);

		return $this->data($data)->add();
	}

}