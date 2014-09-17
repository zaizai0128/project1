<?php
/**
 * 申请作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\BookApplyModel;

class BookApplyService extends BookApplyModel {

	/**
	 * 判断作品是否存在
	 *
	 * @param int 作品id
	 * @return boolean
	 */
	public function checkBookExist($book_id)
	{
		$rs = $this->field('bk_id')->where('bk_id = '.$book_id.' and bk_apply_status != "01"')->find();
		return empty($rs) ? False : True ;
	}

	/**
	 * 判断该作品是否可以提交
	 * 
	 * @param array $book_info
	 */
	public function checkBook($book_info)
	{
		if (empty($book_info['bk_name']))
			return array('code'=>-1, 'msg'=>'书名不允许为空');
		if (empty($book_info['bk_intro']))
			return array('code'=>-11, 'msg'=>'书的描述不允许为空');

		// 在已发售的书中查找该书是否已经存在
		$rs = D('Book')->getIdByName($book_info['bk_name']);

		if (!empty($rs))
			return array('code'=>-2, 'msg'=>'该书名已经存在');

		// 在待审核的书中查找该书名是否存在
		$rs = $this->getIdByName($book_info['bk_name']);

		if (!empty($rs))
			return array('code'=>-3, 'msg'=>'该书名已经存在');

		return array('code'=>1, 'msg'=>'验证通过');
	}
}