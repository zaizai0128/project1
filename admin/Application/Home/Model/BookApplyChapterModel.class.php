<?php
/**
 * 审核作品的章节model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookApplyChapterModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply_chapter';

	/**
	 * 获取某作品下的全部章节
	 *
	 * @param int book_id
	 */
	public function getChapterList($book_id)
	{	
		return $this->where('bk_id = '.$book_id)->select();
	}
}