<?php
/**
 * 章节 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-30
 * @version 1.0
 */
namespace Book\Service;
use Zlib\Model\ZlibChapterModel;
use Zlib\Model\ZlibChapterVipModel;

class ChapterService extends ZlibChapterModel {

	protected $vipInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->vipInstance = new ZlibChapterVipModel();
	}

	/**
	 * 获取章节全部信息
	 */
	public function getInfo()
	{
		$chapter_info = parent::getChapterInfo();

		if ($chapter_info['ch_vip'] == 0) {
			$chapter_info['content'] = parent::getChapterContent();
			
		} else {
			$this->vipInstance = $this->vipInstance->getInstance($chapter_info['bk_id'], $chapter_info['ch_id']);
			$chapter_info['content'] = $this->vipInstance->getChapterContent();
		}
		return $chapter_info;
	}
	

}