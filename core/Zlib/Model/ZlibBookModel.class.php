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