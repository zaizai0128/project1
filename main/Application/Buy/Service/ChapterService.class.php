<?php
/**
 * 章节 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-25
 * @version 1.0
 */
namespace Buy\Service;
use Zlib\Model\ZlibChapterModel;
use Zlib\Model\ZlibChapterVipModel;

class ChapterService extends ZlibChapterModel {

	/**
	 * 获取章节商品信息
	 */
	public function getChapterCommodity()
	{
		$chapterVipInstance = new ZlibChapterVipModel;
		$chapterVipInstance = $chapterVipInstance->getInstance($this->bookId, $this->chapterId);
		return $chapterVipInstance->getVipCommodityInfo();
	}

}