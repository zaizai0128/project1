<?php
/**
 * 申请作品章节 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-24
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookApplyChapterModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply_chapter';

	/**
	 * 添加申请作品章节
	 */
	public function doAddChapter($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 修改申请作品章节
	 */
	public function doEditChapter($data)
	{
		$condition = 'ch_id = '.$data['ch_id'].' and bk_id = '.$data['bk_id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 获取申请作品的章节个数
	 *
	 * @param int book_id
	 */
	public function getTotalChapterNum($book_id)
	{
		$condition = 'bk_id = '.$book_id;
		return (int)$this->where($condition)->count();
	}

	/**
	 * 获取申请作品章节的总数
	 *
	 * @param int book_id
	 */
	public function getTotalSizeChapter($book_id)
	{
		$condition = 'bk_id = '.$book_id;
		return (int)$this->where($condition)->sum('ch_size');
	}

	/**
	 * 获取申请作品章节最大order
	 *
	 * @param int book_id
	 */
	public function getMaxChapterOrder($book_id)
	{
		$condition = 'bk_id = '.$book_id;
		$result = $this->field('count(ch_order) as count, max(ch_order) as max')
						->where($condition)->find();
		$max = $result['count'] == 0 ? 0 : $result['max'] + 1;
		return (int)$max;
	}

	/**
	 * 获取章节信息
	 *
	 * @param int book_id
	 * @param int chapter_id
	 */
	public function getChapterInfo($book_id, $chapter_id, $field='*')
	{
		$condition = 'bk_id = '.$book_id.' and ch_id = '.$chapter_id;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 获取章节信息通过章节名称
	 *
	 * @param int 	 book_id
	 * @param String chapter_name
	 * @param String field
	 * @param String where
	 */
	public function getChapterInfoByName($book_id, $chapter_name, $field='*', $where='')
	{
		$condition = 'bk_id = '.$book_id.' and ch_name = "'.$chapter_name.'"'.$where;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 获取申请章节的列表信息
	 *
	 * @param int book_id
	 */
	public function getChapterList($book_id)
	{
		$condition = 'bk_id = '.$book_id;
		return $this->where($condition)->order('ch_id ASC')->select();
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
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id = '.$data['ch_id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 删除
	 */
	public function doDelete($data)
	{
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id = '.$data['ch_id'];
		return $this->where($condition)->delete();
	}
}