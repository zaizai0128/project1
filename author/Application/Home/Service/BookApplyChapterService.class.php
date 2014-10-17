<?php
/**
 * 申请作品的章节 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-24
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibBookApplyChapterModel;

class BookApplyChapterService extends ZlibBookApplyChapterModel {
	
	/**
	 * 添加一本审核章节
	 * 
	 * @return array 
	 */
	public function doAddApplyChapter($data)
	{
		if (empty($data['bk_id'])) return z_info(-1, '作品不存在'); 
		if (empty($data['ch_name'])) return z_info(-2, '章节名不允许为空'); 
		if (empty($data['content'])) return z_info(-3, '章节内容不允许为空'); 

		// 判断是否超过了最大限制章节数
		$max = parent::getTotalChapterNum($data['bk_id']);
		if ($max >= C('APPLY.max_chapter_num')) return z_info(-4, '超过了最大限制');

		// 判断是否章节重名
		if (!$this->_checkChapterName($data['bk_id'], $data['ch_name']))
			return z_info(-5, '章节名已经存在');

		// 判断是不是首章，如果是首章节，则需要判断章节字数够不够
		$strlen = z_strlen($data['content']);
		if ($this->_checkChapterFirst($data['bk_id'])) {
			if ($strlen < 2000 || $strlen > 30000) {
				return z_info(-6, '首章字数必须为2000-30000之间');
			}
		}

		// 其他验证 ...
		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_cre_time'] = z_now();
		$final_data['ch_update'] = z_now();
		$final_data['ch_name'] = $data['ch_name'];
		$final_data['ch_order'] = parent::getMaxChapterOrder($data['bk_id']);
		$final_data['ch_size'] = $strlen;
		$final_data['ch_status'] = 0;
		$final_data['ch_content'] = $data['content'];
		$final_data['ch_intro'] = $data['intro'];
		
		$ch_id = parent::doAddChapter($final_data);

		if ($ch_id > 0)
			return z_info($ch_id, '添加成功');
		else
			return z_info(0, '添加失败');
	}

	/**
	 * 修改审核章节内容
	 */
	public function doEditApplyChapter($data)
	{
		if (empty($data['bk_id'])) return z_info(-1, '作品不存在'); 
		if (empty($data['ch_id'])) return z_info(-1, '章节不存在'); 
		if (empty($data['ch_name'])) return z_info(-2, '章节名不允许为空'); 
		if (empty($data['content'])) return z_info(-3, '章节内容不允许为空'); 

		// 判断是否章节重名
		if (!$this->_checkChapterName($data['bk_id'], $data['ch_name'], $data['ch_id']))
			return z_info(-5, '章节名已经存在');

		// 判断是不是首章，如果是首章节，则需要判断章节字数够不够
		$strlen = z_strlen($data['content']);
		if ($this->_checkChapterFirst($data['bk_id'], $data['ch_id'], True)) {
			if ($strlen < 2000 || $strlen > 30000) {
				return z_info(-6, '首章字数必须为2000-30000之间');
			}
		}

		// 其他验证 ...

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_id'] = $data['ch_id'];
		$final_data['ch_size'] = z_strlen($data['content']);
		$final_data['ch_content'] = $data['content'];
		$final_data['ch_name'] = $data['ch_name'];
		$final_data['ch_update'] = z_now();
		$final_data['ch_intro'] = $data['intro'];

		$result = parent::doEditChapter($final_data);

		if ($result > 0)
			return z_info($result, '修改成功');
		else
			return z_info(0, '修改失败');
	}

	/**
	 * 判断章节是否是首章
	 */
	private function _checkChapterFirst($book_id, $chapter_id = Null, $is_edit = False)
	{
		if ($is_edit) {
			// 编辑的时候，获取ch_order的值，如果为0，则是首章
			$info = parent::getChapterInfo($book_id, $chapter_id, 'ch_order');
			return $info['ch_order'] == 0 ? True : False;

		} else {
			// 创建的时候，判断章节个数，如果为0个，则说明是首章
			$total = parent::getTotalChapterNum($book_id);
			return $total == 0 ? True : False;
		}
	}

	/**
	 * 判断章节名是否重名
	 * @param int book_id
	 * @param String chapter_name
	 * @param int chapter_id
	 */
	private function _checkChapterName($book_id, $chapter_name, $chapter_id = Null)
	{	
		// 添加的时候判断
		if (!isset($chapter_id)) {
			$result = parent::getChapterInfoByName($book_id, $chapter_name, 'ch_id');
		// 修改的时候判断
		} else {
			$result = parent::getChapterInfoByName($book_id, $chapter_name, 'ch_id', ' and ch_id != '.$chapter_id);
		}
		return empty($result) ? True : False;
	}
}