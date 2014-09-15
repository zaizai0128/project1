<?php
/**
 * 作品申请model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookApplyModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply';

	/**
	 * 获取作品总数
	 */
	public function getTotal($where = Null)
	{
		$condition = 'bk_apply_status = "00"';
		if (!empty($where))
			$condition = $where;
		return $this->where($condition)->count();
	}

	/**
	 * 获取作品列表
	 *
	 * @param String  条件
	 * @param int 分页
	 * @param int 显示条数
	 */
	public function getApplyList($where = Null, $firstRow, $listRows = 10)
	{
		$condition = 'bk_apply_status = "00"';
		if (!empty($where))
			$condition = $where;
		return $this->where($condition)->limit($firstRow, $listRows)->select();
	}

	/**
	 * 获取作品的信息
	 *
	 * @param int book_id
	 */
	public function getInfo($book_id)
	{
		return $this->where('bk_id = '.$book_id)->find();
	}

	/**
	 * 修改作品信息
	 */
	public function doEdit($book)
	{	
		return $this->data($book)->save();
	}
}