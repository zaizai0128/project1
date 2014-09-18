<?php
/**
 * 章节 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-17
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\ChapterModel;

class ChapterService extends ChapterModel {
	
	/**
	 * 检测chapter数据
	 *
	 * @param array chapter_info
	 * @param boolean 是否是添加操作
	 */
	public function checkChapter($chapter_info, $is_add = True)
	{
		if (empty($chapter_info['bk_id']))
			return array('code'=>-1, 'msg'=>'作品序号不允许为空');

		if (empty($chapter_info['ch_name'])) 
			return array('code'=>-2, 'msg'=>'章节名称不允许为空');

		if (empty($chapter_info['ch_content']))
			return array('code'=>-3, 'msg'=>'章节内容不允许为空');


		return array('code'=>1, 'msg'=>'验证通过');
	}

	/**
	 * 创建新的章节
	 *
	 * @param array chapter_info
	 */
	public function createNewChapter($chapter_info)
	{
		$chapter_info = array_filter($chapter_info);
		$chapter_info['ch_roll'] = empty($chapter_info['ch_roll']) ? C('BK.start_volume') : (int)$chapter_info['ch_roll'];
		$chapter_info['ch_cre_time'] = date('Y-m-d H:i:s', time());
		$chapter_info['ch_update'] = date('Y-m-d H:i:s', time());
		$chapter_info['ch_order'] = $this->getLastChapterOrder();
		$chapter_info['ch_poster_id'] = ZS('S.author', 'user_id');
		$chapter_info['ch_poster'] = ZS('S.author','author_name');
		$chapter_info['ch_size'] = mb_strlen($chapter_info['ch_content']);

		// 保存到文件or其他地方
		$chapter_content = $chapter_info['ch_content'];
		unset($chapter_info['ch_content']);

		// 保存到db中
		return self::doAdd($chapter_info);
	}
}