<?php
/**
 * 章节 zlib/model
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibChapterModel extends BaseModel {

	protected $bookId = Null;			// 作品id
	protected $chapterId = Null;		// 章节id
	protected $instance = Null;			// chapter表对象
	
	public function getInstance($book_id, $chapter_id = Null)
	{
		$this->bookId = $book_id;
		$this->chapterId = $chapter_id;
		$this->instance = M($this->getTableName());
		return $this;
	}

	/**
	 * 获取章节内容
	 */
	public function getChapterInfo()
	{
		$condition = 'bk_id = '.$this->bookId.' and ch_id = '.$this->chapterId;
		return $this->instance->where($condition)->find();
	}

	/**
	 * 获取同卷下的相邻章节内容
	 *
	 * @param int 卷id
	 */
	public function getSiblingChapter($roll_id)
	{
		$sibling = array();

		// 上一章
		$condition = 'bk_id = '.$this->bookId.' and ch_id < '.$this->chapterId.' and ch_roll = '.$roll_id.' and ch_status = 0';
		$sibling['prev'] = $this->instance->field('ch_id,ch_name,ch_vip')
							->where($condition)->order('ch_id desc')->find();

		// 下一章
		$condition = 'bk_id = '.$this->bookId.' and ch_id > '.$this->chapterId.' and ch_roll='.$roll_id.' and ch_status = 0';
		$sibling['next'] = $this->instance->field('ch_id,ch_name,ch_vip')
							->where($condition)->order('ch_id asc')->find();
		return $sibling;
	}

	/**
	 * 获取普通章节内容
	 */
	public function getChapterContent()
	{

	}

	/**
	 * 获取章节表名
	 */
	public function getTableName()
	{
		return 'zl_book_chapter_' . sprintf('%02d', $this->bookId / 30000);
	}

}