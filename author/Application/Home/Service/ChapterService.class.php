<?php
/**
 * 章节 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-17
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibChapterModel;

class ChapterService extends ZlibChapterModel {

	/**
	 * 修改章节所属的卷
	 */
	public function doEditBookVolume($data)
	{
		if (empty($data['bk_id'])) return z_info(-1, '作品不存在');
		if (empty($data['ch_id'])) return z_info(-2, '章节不存在');
		if (empty($data['ch_roll'])) return z_info(-3, '卷号不存在');

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_id'] = $data['ch_id'];
		$final_data['ch_roll'] = $data['ch_roll'];

		$result = parent::doEdit($final_data);

		if ($result)
			return z_info(1, '修改成功');
		else
			return z_info(0, '修改失败');
	}

	/**
	 * override
	 */
	public function getChapterInfo()
	{
		$chapter_info = parent::getChapterInfo();

		if ($chapter_info['ch_vip'] == 1) {
			$vip_chapter = D('ChapterVip', 'Service')->getInstance($chapter_info['bk_id'], $chapter_info['ch_id']);
			$chapter_info['ch_content'] = $vip_chapter->getChapterContent();
		} else {
			$get_content_url = C('CHAPTER.read').'/'.$chapter_info['bk_id'].'/'.$chapter_info['ch_id'];
			$chapter_info['ch_content'] = file_get_contents($get_content_url);
			$chapter_info['ch_content'] = parent::getChapterContent();
		}
		
		return $chapter_info;
	}
	
	/**
	 * 修改章节内容
	 */
	public function doEdit($data)
	{
		$data = array_filter($data);
		$state = $this->_checkChapter($data, True);
		if ($state['code'] <= 0) return $state;

		$vip = parent::getChapterInfo('ch_vip');
		if (empty($vip)) return z_info(0, '章节不存在');

		$chapter_info['ch_update'] = z_now();
		$chapter_info['ch_size'] = z_strlen($data['content']);
		$chapter_info['ch_name'] = $data['ch_name'];
		$chapter_info['ch_roll'] = $data['volume'];
		$chapter_info['ch_id'] = $data['ch_id'];
		$chapter_info['bk_id'] = $data['bk_id'];
		$chapter_info['ch_vip'] = (int)$data['vip'];
		$result = parent::doEdit($chapter_info);

		if ($result) {

			// 更新内容
			if ($chapter_info['ch_vip'] == 1) {

				$vip_chapter = D('ChapterVip', 'Service')->getInstance($chapter_info['bk_id'], $chapter_info['ch_id']);
				$vip_info = $vip_chapter->getChapterInfo('bk_id');
				
				if (empty($vip_info)) {
					$vip_chapter->doAdd($data);
				} else {
					$vip_chapter->doEdit($data);
				}
			} else {

				// 更新内容
				parent::setChapterContent($chapter_info['ch_id'], $data['content']);
			}

			return z_info($result, '修改成功');
		} else {

			return z_info($result, '修改失败');
		}
	}

	/**
	 * 创建新的章节
	 *
	 */
	public function doAdd($data)
	{	
		$data = array_filter($data);
		$state = $this->_checkChapter($data);
		if ($state['code'] <= 0) return $state;

		$chapter_info['bk_id'] = $data['bk_id'];
		$chapter_info['ch_roll'] = empty($data['volume']) ? C('BOOK.start_volume') : (int)$data['volume'];
		$chapter_info['ch_cre_time'] = z_now();
		$chapter_info['ch_update'] = z_now();
		$chapter_info['ch_order'] = parent::getLastChapterOrder();
		$chapter_info['ch_size'] = z_strlen($data['content']);
		$chapter_info['ch_name'] = $data['ch_name'];
		$chapter_info['ch_status'] = 0;
		$chapter_info['ch_vip'] = (int)$data['vip'];
		$chapter_content = $data['content'];

		$chapter_id = parent::doAdd($chapter_info);
		
		if (empty($chapter_id)) return z_info(0, '添加失败');

		// 如果是vip，则将内容存放到数据库中，如果是普通章节，则生成静态页
		if ($chapter_info['ch_vip'] == 1) {
			$chapter_info['content'] = $chapter_content;
			$chapter_info['ch_id'] = $chapter_id;
			$vip_chapter = D('ChapterVip', 'Service')->getInstance($data['bk_id'], $chapter_id);
			$vip_chapter->doAdd($chapter_info);

		// 普通章节处理
		} else {
			
			parent::setChapterContent($chapter_id, $chapter_content);
		}

		return z_info($chapter_id, '添加成功');
	}

	/**
	 * 检测chapter数据
	 *
	 * @param array 
	 * @param boolean 是否是修改操作
	 */
	private function _checkChapter($data, $is_edit = False)
	{
		if (empty($data['bk_id']))
			return z_info(-1, '作品序号不允许为空');

		if (empty($data['ch_name'])) 
			return z_info(-2, '章节名称不允许为空');

		if (empty($data['content']))
			return z_info(-3, '章节内容不允许为空');

		if (empty($data['volume']))
			return z_info(-4, '卷不允许为空');

		// 其他验证 ...

		if ($is_edit) {
			if (empty($data['ch_id']))
				return z_info(-11, '章节id不允许为空');

			// 判断章节名是否重复
			$chapter_info = parent::getChapterInfoByName($data['ch_name'], 'ch_name', ' and ch_id != '.$data['ch_id']);
		} else {

			// 判断章节名是否重复
			$chapter_info = parent::getChapterInfoByName($data['ch_name'], 'ch_name');
		}

		if (!empty($chapter_info))
			return z_info(-4, '章节名重复');

		return array('code'=>1, 'msg'=>'验证通过');
	}
}