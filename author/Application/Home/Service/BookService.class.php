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
	 * 判断作品是否存在
	 *
	 * @param int 作品id
	 * @return boolean
	 */
	public function checkBookExist($book_id)
	{
		$rs = $this->field('bk_id')->where('bk_id = '.$book_id.' and bk_status = "00"')->find();
		return empty($rs) ? False : True ;
	}
}