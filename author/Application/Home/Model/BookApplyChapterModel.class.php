<?php
/**
 * 申请作品章节model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookApplyChapterModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply_chapter';

	/**
	 * 为申请作品添加章节
	 * 
	 * @param Array 章节信息
	 */
	public function doAdd($data)
	{
		$data['ch_cre_time'] = date('Y-m-d H:i:s', time());
		$data['ch_update'] = date('Y-m-d H:i:s', time());
		$data['ch_size'] = mb_strlen($data['ch_content']);

		return $this->data($data)->add();
	}

	/**
	 * 修改章节
	 */
	public function doEdit($data)
	{
		$data['ch_update'] = date('Y-m-d H:i:s', time());
		$data['ch_size'] = mb_strlen($data['ch_content']);

		return $this->data($data)->save();
	}

	/**
	 * 获取章节的内容
	 * @param int $ch_id
	 */
	public function getApplyChapterInfo($book_id, $ch_id)
	{
		return $this->where('ch_id = '.$ch_id.' and bk_id = '.$book_id)->find();
	}

	/**
	 * 获取总章节数
	 *
	 * @param int $book_id
	 */
	public function getTotal($book_id)
	{
		return $this->where('bk_id = '.$book_id)->count();
	}

	/**
	 * 获取章节列表
	 *
	 * @param int $book_id
	 */
	public function getList($book_id, $firstRow, $listRows)
	{
		return $this->where('bk_id = '.$book_id)
				->order('ch_id DESC')->limit($firstRow, $listRows)->select();
	}

	/**
	 * 获取章节的最后ch_order
	 *
	 * @param int book_id
	 */
	public function getLastChapterOrder($book_id)
	{
		$rs = $this->field('ch_order')->where('bk_id = '.$book_id)
				->order('ch_order desc')
				->find();
		return empty($rs) ? 1 : $rs['ch_order']+1;
	}

}