<?php
/**
 * 作品 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookVolumeModel extends BaseModel {

	protected $trueTableName = 'zl_book_volume';

	/**
	 * 获取一本书的所有卷信息
	 *
	 * @param int $book_id
	 * @return Array
	 */
	public function getVolumeById($book_id)
	{
		$condition = 'bk_id = '.$book_id.' and volume_status = 0';
		return $this->where($condition)->order('volume_order ASC')->select();
	}

	/**
	 * 通过卷名称获取卷信息
	 *
	 * @param int book_id
	 * @param String volume_name
	 * @param String field
	 * @param String where
	 */
	public function getVolumeByName($book_id, $volume_name, $field='*',$where = Null)
	{
		$condition = 'bk_id = '.$book_id.' and volume_name = "'
				.$volume_name.'" and volume_status = 0';

		if(!empty($where))
			$condition .= ' and '.$where;

		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 获取最后卷id
	 * 
	 * @param book_id
	 */
	public function getLastVolumeOrder($book_id)
	{
		$max = $this->where('bk_id = '.$book_id.' and volume_status = 0')->max('volume_order');
		return empty($max) ? C('BOOK.start_volume') : $max+1;
	}

	/**
	 * 获取卷信息
	 */
	public function getVolumeInfo($book_id, $volume_id, $field='*')
	{
		$condition = 'bk_id = '.$book_id.' and volume_id = '.$volume_id;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 创建卷信息
	 */
	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 修改卷信息
	 */
	public function doEdit($data)
	{
		$condition = 'bk_id = '.$data['bk_id'].' and volume_id = '.$data['volume_id'];
		return $this->where($condition)->data($data)->save();
	}
}