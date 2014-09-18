<?php
/**
 * 章节 model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-17
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;
use Zlib\Api as Zapi;

class ChapterModel extends BaseModel {
	
	protected $chapter_obj;
	protected $book_id;

	/**
	 * 根据book_id 初始化model对象
	 */
	public function init($book_id)
	{
		$this->book_id = $book_id;
		$this->chapter_obj = M(Zapi\Chapter::getName($book_id));
		return $this;
	}

	/**
	 * 获取章节的最后ch_order
	 */
	public function getLastChapterOrder()
	{
		$rs = $this->chapter_obj->field('max(ch_order) as max_order')->where('bk_id = '.$this->book_id)
				->order('ch_order desc')
				->find();
		return empty($rs) ? 1 : $rs['max_order']+1;
	}

	/**
	 * 获取总数
	 */
	public function getTotal()
	{
		$rs = $this->chapter_obj->where('bk_id = '.$this->book_id)
				->count();
		return (int)$rs;
	}

	/**
	 * 分页获取总章节数
	 */
	public function getList($firstRow, $listsRows)
	{
		return $this->chapter_obj->where('bk_id = '.$this->book_id.' and ch_status = "0"')->order('ch_order ASC')
				->limit($firstRow, $listsRows)->select();
	}

	/**
	 * 获取章节的详情
	 */
	public function getChapterInfo($chapter_id)
	{
		return $this->chapter_obj->where('bk_id='.$this->book_id.' and ch_id = '.$chapter_id.' and ch_status = "0"')
				->find();
	}
	
	/**
	 * 执行添加操作
	 */
	public function doAdd($data)
	{
		return $this->chapter_obj->data($data)->add();
	}
}