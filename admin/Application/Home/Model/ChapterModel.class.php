<?php
/**
 * 章节model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;
use Zlib\Api as Zapi;

class ChapterModel extends BaseModel {

	private $_chapter_obj;

	/**
	 * 初始化数据库对象
	 *
	 * @param int $book_id
	 */
	public function init($book_id)
	{
		$chapter_table_name = Zapi\Chapter::getName($book_id);
		$this->_chapter_obj = M($chapter_table_name);
		return $this;
	}

	/**
	 * 添加章节内容
	 *
	 * @param Array  章节信息
	 */
	public function createChapter($chapter)
	{
		$content = $chapter['ch_content'];
		unset($chapter['ch_content']);
		unset($chapter['ch_id']);
		$chapter_id = $this->_chapter_obj->add($chapter);

		if ($chapter_id > 0) {
			// 将内容保存到文件中
			// echo $content;
		}

		return $chapter_id;
	}

	/**
	 * 获取作品最后章节内容
	 * 
	 * @param int book_id
	 */
	public function getLastChapter($book_id)
	{
		return $this->_chapter_obj->where('bk_id = '.$book_id)->order('ch_id DESC')->find();
	}
}