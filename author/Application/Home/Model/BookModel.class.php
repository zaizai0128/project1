<?php
/**
 * 作品model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookModel extends BaseModel {

	protected $trueTableName = 'zl_book';

	/**
	 * 通过书名查找书的id
	 */
	public function getIdByName($book_name)
	{
		return $this->field('bk_id')->where('bk_name = "'.$book_name.'"')->find();
	}
}