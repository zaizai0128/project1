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
	 * 修改章节内容
	 */
	public function doEdit($data)
	{
		$chapter_content = $data['ch_content'];
		$data['ch_update'] = date('Y-m-d H:i:s', time());
		$data['ch_size'] = mb_strlen($data['ch_content'], C('SYSTEM.encoded'));
		unset($data['ch_content']);
		$rs = parent::doEdit($data);

		// 修改章节内容文件
		$nginx_module_set = C('CH.set').'/'.$data['bk_id'].'/'.$data['ch_id'];
		z_request_post($nginx_module_set, $chapter_content);
		
		return $rs;
	}

	/**
	 * override
	 */
	public function getChapterInfo($chapter_id)
	{
		$chapter_info = parent::getChapterInfo($chapter_id);
		$get_content_url = C('CH.read').'/'.$this->book_id.'/'.$chapter_id;
		$chapter_info['ch_content'] = file_get_contents($get_content_url);
		$chapter_info['ch_content'] = substr($chapter_info['ch_content'], 4);
		return $chapter_info;
	}
	
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
		$chapter_info['ch_size'] = mb_strlen($chapter_info['ch_content'], C('SYSTEM.encoded'));

		// 保存到文件or其他地方
		$chapter_content = $chapter_info['ch_content'];
		unset($chapter_info['ch_content']);
		$book_id = $chapter_info['bk_id'];

		// 保存到db中
		$chapter_id = parent::doAdd($chapter_info);

		if (empty($chapter_id))
			return False;

		// 如果是vip，则将内容存放到数据库中，如果是普通章节，则生成静态页
		if ($chapter_info['ch_vip'] == 1) {
			$chapter_info['ch_content'] = $chapter_content;
			$chapter_info['ch_id'] = $chapter_id;
			$vip_chapter = D('ChapterVip', 'Service')->getInstance($book_id, $chapter_id);
			$vip_chapter->doAdd($chapter_info);

		// 普通章节处理
		} else {
			$nginx_module_set = C('CH.set').'/'.$book_id.'/'.$chapter_id;
			$info = z_request_post($nginx_module_set, $chapter_content);
		}

		return $chapter_id;
	}
}