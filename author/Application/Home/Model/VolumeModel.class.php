<?php
/**
 * 书卷model
 * 
 * 默认 卷id 为 1000 
 * 后期如果作者自己创建了id，则每一卷的间隔为1000 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class VolumeModel extends BaseModel {

	protected $trueTableName = 'zl_book_volume';
	
	/**
	 * 获取一本书的所有卷信息
	 *
	 * @param int $book_id
	 * @return Array
	 */
	public function getVolumeById($book_id)
	{
		return $this->where('bk_id = '.$book_id.' and volume_status = 0')->order('volume_order asc')->select();
	}

	/**
	 * 通过卷名称获取卷id
	 *
	 * @param int book_id
	 * @param String volume_name
	 * @param String extend_where
	 */
	public function getVolumeIdByName($book_id, $volume_name, $extend_where = Null)
	{
		$where = 'bk_id = '.$book_id.' and volume_name = "'
				.$volume_name.'" and volume_status = 0';

		if(!empty($extend_where))
			$where .= ' and '.$extend_where;

		return $this->field('volume_id')->where($where)->find();
	}

	/**
	 * 为一本书创建卷信息
	 */
	public function doAdd($volume_info)
	{
		$volume_info['volume_status'] = 0;
		return $this->data($volume_info)->add();
	}

	/**
	 * 修改卷信息
	 */
	public function doEdit($volume_info)
	{
		return $this->data($volume_info)->save();
	}
}