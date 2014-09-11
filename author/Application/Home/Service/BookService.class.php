<?php
/**
 * 作品的 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\BaseModel;

class BookService extends BaseModel {

	protected $trueTableName = 'zl_book';

	/**
	 * 判断书名是否可用
	 * 
	 * @param String $book_name
	 */
	public function checkBookName($book_name)
	{
		if (empty($book_name))
			return array('code'=>-1, 'msg'=>'书名不允许为空');

		$rs = $this->field('bk_id')->where('bk_name = "'.$book_name.'"')->find();

		if (!empty($rs))
			return array('code'=>-2, 'msg'=>'该书名已经存在');

		$rs = M('zl_book_apply')->field('bk_id')->where('bk_name = "'.$book_name.'"')->find();

		if (!empty($rs))
			return array('code'=>-3, 'msg'=>'该书名已经存在');

		return array('code'=>1, 'msg'=>'验证通过');
	}
}