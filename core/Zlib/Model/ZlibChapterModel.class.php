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
	 * 获取申请作品的章节个数
	 */
	public function getTotalChapterNum()
	{
		$condition = 'bk_id = '.$this->bookId;
		return (int)$this->instance->where($condition)->count();
	}

	/**
	 * 获取申请作品章节的总数
	 */
	public function getTotalSizeChapter()
	{
		$condition = 'bk_id = '.$this->bookId;
		return (int)$this->instance->where($condition)->sum('ch_size');
	}

	/**
	 * 保存
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
	 * 获取章节内容
	 * @param string field
	 */
	public function getChapterInfo($field = '*')
	{
		$condition = 'bk_id = '.$this->bookId.' and ch_id = '.$this->chapterId;
		return $this->instance->field($field)->where($condition)->find();
	}

	/**
	 * 通过章节名称，获取章节内容
	 *
	 * @param String name
	 * @param String field
	 */
	public function getChapterInfoByName($name, $field='*', $where='')
	{
		$condition = 'bk_id = '.$this->bookId.' and ch_name = "'.$name.'"'.$where;
		return $this->instance->field($field)->where($condition)->find();
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
	 * 获取最后章节order
	 */
	public function getLastChapterOrder()
	{
		$condition = 'bk_id = '.$this->bookId;
		$max = $this->instance->where($condition)->max('ch_order');
		return empty($max) ? 0 : $max+1 ;
	}

	/**
	 * 获取章节表名
	 */
	public function getTableName()
	{
		return 'zl_book_chapter_' . sprintf('%02d', $this->bookId / 30000);
	}

	/**
	 * 获取普通章节内容详情
	 */
	public function getChapterContent()
	{
		$chapter_read = C('CHAPTER.read') . '/'.$this->bookId.'/'.$this->chapterId;
		$content = file_get_contents($chapter_read);
		// 获取头4位编码, 用来判断获取状态
		$status = substr($content, 0, 3);
		// 如果前3位不为000 ，则返回False
		if ($status != '000')
			return False;
		
		// 返回内容
		return substr($content, 4);
	}

	/**
	 * 设置普通章节内容静态文件
	 *
	 * @param int chapter_id
	 * @param String 内容
	 */
	public function setChapterContent($chapter_id, $content)
	{
		$chapter_set = C('CHAPTER.set') . '/'.$this->bookId.'/'.$chapter_id;
		$info = z_request_post($chapter_set, $content);
		// 判断 info返回的内容
		return True;
	}

}