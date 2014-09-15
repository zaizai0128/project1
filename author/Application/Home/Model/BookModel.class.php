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

	/**
	 * 获取作品的信息
	 *
	 * @param int book_id
	 */
	public function getBookInfo($book_id)
	{
		return $this->where('bk_id = '.$book_id.' and bk_status = "00"')->find();
	}

	/**
	 * 查找用户拥有的书
	 *
	 * @param user_id
	 */
	public function getBookListByUid($user_id)
	{
		return $this->where('bk_author_id = '.$user_id)->order('bk_id DESC')->select();
	}

	/**
	 * 通过作者id查找该用户拥有的书id
	 * 
	 * @param user_id
	 */
	public function getOwnBook($user_id)
	{
		$rs = $this->field('bk_id')->where('bk_author_id = '.$user_id)->select();

		if (!empty($rs))
			$rs = array_map(function($val){return $val['bk_id'];}, $rs);

		return $rs;
	}
}