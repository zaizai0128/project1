<?php
/**
 * 章节 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibChapterModel;

class ChapterService extends ZlibChapterModel { 
	
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
		$chapter_id = $this->doAdd($chapter);

		if ($chapter_id > 0) {		
			$this->setChapterContent($chapter_id, $content);
		}
		return $chapter_id;
	}
}