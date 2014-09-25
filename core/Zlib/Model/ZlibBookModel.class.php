<?php
/**
 * 作品 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookModel extends BaseModel {

	protected $trueTableName = 'zl_book';

	/**
	 * 获取作者的书籍
	 * @param int user_id
	 * @param String field
	 * @param String where
	 */
	public function getBookByUserId($user_id, $field='*', $where='')
	{
		$condition = 'bk_author_id = '.$user_id.$where;
		return $this->field($field)->where($condition)->order('bk_cre_time DESC')->select();
	}

	/**
	 * 获取作品信息通过名称
	 * @param String book_name
	 * @param String field
	 * @param String where
	 */
	public function getBookByName($book_name, $field='*', $where='')
	{
		$condition = 'bk_name = "'.$book_name.'"'.$where;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 *  获取作品信息通过作品id
	 * @param String book_id
	 * @param String field
	 * @param String where
	 */
	public function getBookByBookId($book_id, $field='*', $where='')
	{
		$condition = 'bk_id = "'.$book_id.'"'.$where;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 添加
	 */
	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		$condition = 'bk_id = '.$data['bk_id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 删除
	 */
	public function doDelete($data)
	{
		$condition = 'bk_id = '.$data['bk_id'];
		return $this->where($condition)->delete();
	}
}