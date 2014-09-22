<?php
/**
 * vip章节 	zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibChapterVipModel extends BaseModel {

	protected $bookId = Null;
	protected $chapterId = Null;
	protected $instance = Null;

	/**
	 * 获取ChapterVip的model对象
	 */
	public function getInstance($book_id, $chapter_id)
	{
		$this->bookId = $book_id;
		$this->chapterId = $chapter_id;
		$this->instance = M($this->getTableName());
		return $this;
	}

	/**
	 * 获取vip内容
	 */
	public function getChapterContent()
	{
		$condition = 'bk_id = '.$this->bookId.' and ch_id = '.$this->chapterId;
		return $this->instance->field('ch_content')->where($condition)->find();
	}

	/**
	 * 创建
	 */
	public function doAdd($data)
	{
		return $this->instance->data($data)->add();
	}

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id = '.$data['ch_id'];
		return $this->instance->where($condition)->data($data)->save();
	}

	/**
	 * 删除
	 */
	public function doDelete($data)
	{
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id = '.$data['ch_id'];
		return $this->instance->where($condition)->delete();
	}

	/**
	 * 获取vip章节表名
	 */
	public function getTableName()
	{
		return 'zl_chapter_vip_' . sprintf('%02d', $this->chapterId % 10);
	}	
}