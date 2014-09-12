<?php
/**
 * 作品的 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\BookModel;

class BookService extends BookModel {

	/**
	 * 判断该作品是否可以提交
	 * 
	 * @param String $book_name
	 */
	public function checkBook($book)
	{
		if (empty($book['bk_name']))
			return array('code'=>-1, 'msg'=>'书名不允许为空');
		if (empty($book['bk_intro']))
			return array('code'=>-11, 'msg'=>'书的描述不允许为空');

		// 在已发售的书中查找该书是否已经存在
		$rs = $this->getIdByName($book['bk_name']);

		if (!empty($rs))
			return array('code'=>-2, 'msg'=>'该书名已经存在');

		// 在待审核的书中查找该书名是否存在
		$rs = D('BookApply')->getIdByName($book['bk_name']);

		if (!empty($rs))
			return array('code'=>-3, 'msg'=>'该书名已经存在');

		return array('code'=>1, 'msg'=>'验证通过');
	}
}