<?php
/**
 * 书卷model
 * 
 * 默认 卷id 为 1000 
 * 后期如果作者自己创建了id，则每一卷的间隔为1000 
 *
 *
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
	 */
	public function getVolumeById($book_id)
	{

	}

	/**
	 * 为一本书创建卷信息
	 */
	public function create()
	{

	}
}