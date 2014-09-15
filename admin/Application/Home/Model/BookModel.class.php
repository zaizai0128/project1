<?php
/**
 * 作品model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookModel extends BaseModel {

	protected $trueTableName = 'zl_book';

	/**
	 * 创建新的作品，审核通过后创建的作品
	 *
	 *
	 * @return int 返回书籍的id
	 */
	public function createNewBook($book)
	{

		return $this->data($book)->add();
	}

	/**
	 * 更新作品最后章节的信息
	 *
	 * @param Array 最后章节信息
	 */
	public function editBookLastChapter($chapter)
	{
		return $this->data($chapter)->save();
	}
}