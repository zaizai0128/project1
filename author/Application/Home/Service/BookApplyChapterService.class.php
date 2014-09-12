<?php
/**
 * 申请作品的章节 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\BookApplyChapterModel;

class BookApplyChapterService extends BookApplyChapterModel {

	/**
	 * 判断该章节是否可以发布
	 * 
	 * @param String $book_name
	 * @param boolean 是否是添加操作
	 */
	public function checkChapter($chapter, $isAdd = True)
	{
		if (empty($chapter['bk_id']))
			return array('code'=>-1, 'msg'=>'作品id不允许为空');
		if (empty($chapter['ch_name']))
			return array('code'=>-2, 'msg'=>'章节名称不允许为空');
		if (empty($chapter['ch_content']))
			return array('code'=>-21, 'msg'=>'章节内容不允许为空');

		if ($isAdd) {

			$rs = $this->where('bk_id='.$chapter['bk_id'].' and ch_name = "'.$chapter['ch_name'].'"')->find();
			if (!empty($rs))
				return array('code'=>-3, 'msg'=>'该章节名称已存在');

			// 申请中的作品最大上传章节数限制
			$total = $this->where('bk_id='.$chapter['bk_id'])->count();
			if ($total >= C('APPLY.max_chapter_num'))
				return array('code'=>-4, 'msg'=>'超过最大章节数限制');

		} else {
			
			if (empty($chapter['ch_id']))
				return array('code'=>-11, 'msg'=>'章节id不允许为空');
		}
		
		return array('code'=>1, 'msg'=>'验证通过');
	}
}