<?php
/**
 * 申请作品 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-24
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookApplyModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply';
	
	/**
	 * 通过用户id查找正在申请的图书
	 * @param int user_id
	 * @param string 字段
	 * @param string 扩展条件
	 */
	public function getApplyBookByUserId($user_id, $field = '*', $where = '')
	{
		$condition = 'bk_author_id = '.$user_id.$where;
		return $this->field($field)->where($condition)
				->order('bk_cre_time DESC')->select();
	}

	/**
	 * 通过用户id和书籍id查找对应的一本正在申请的图书
	 *
	 * @param int user_id
	 * @param int book_id
	 * @param string 字段
	 * @param string 扩展条件
	 */
	public function getOneApplyBook($user_id, $book_id, $field='*', $where='')
	{
		$condition = 'bk_id = '.$book_id.' and bk_author_id = '.$user_id;
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

	/**
	 * 通过作品名称获取申请作品信息
	 *
	 * @param String book_name
	 * @param String field
	 * @param String where
	 */
	public function getApplyBookByName($book_name, $field='*', $where='')
	{
		$condition = 'bk_name = "'.$book_name.'"';
		return $this->field($field)->where($condition)->find();
	}
}