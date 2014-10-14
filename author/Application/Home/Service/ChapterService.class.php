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

	protected $filterInstance = Null;
	protected $filterApi = Null;

	public function __construct()
	{
		parent::__construct();
		$this->filterInstance = D('Filter', 'Service');
		$this->filterApi = \Zlib\Api\FilterWords::getInstance();
	}

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
		$state = $this->_checkChapter($data, True);
		if ($state['code'] <= 0) return $state;

		$data['content'] = $this->filterApi->filter($data['content']);
		$chapter_info['ch_update'] = z_now();
		$chapter_info['ch_size'] = z_strlen($data['content']);
		$chapter_info['ch_name'] = $data['ch_name'];
		
		if (isset($data['volume']) && !empty($data['volume'])) {
			$chapter_info['ch_roll'] = $data['volume'];
		}
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
		$state = $this->_checkChapter($data);
		if ($state['code'] <= 0) return $state;

		$data['content'] = $this->filterApi->filter($data['content']);
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

		// 如果添加vip章节，则判断该作品的签约状态
		if ($data['vip'] == 1) {
			// pass
		}

		// 判断书籍状态
		if ($data['bk_fullflag'] != 0) {
			return z_info(-10, '非连载的作品无法编辑');
		}

		if ($data['bk_status'] != '00') {
			return z_info(-11, '作品状态有问题，无法编辑');
		}

		// 关键字过滤验证
		$word = $this->filterApi->hasDeadWord($data['content']);

		// 如果含有敏感词汇，则将该章节添加到审核表
		if ($word) {

			// 将该章节内容存放到审核表中
			$this->filterInstance->doAddDeadFilter($data);
			return z_info(-31, '含有政治敏感词汇，将暂停您的作品，等待客服解封');
		} else {

			// 如果含有普通词汇个数 超过了 规定个数，将该章节添加到审核表中，禁止作品编辑
			$wordNum = $this->filterApi->getFilterWord($data['content']);
			
			if (count($wordNum) >= C('FILTER.word_num')) {
				$this->filterInstance->doAddDeadFilter($data);
				return z_info(-32, '含有'.$count($wordNum).'个非法词汇，将暂停您的作品，等待客服解封');

			// 如果不超过 规定个数
			} else {
				// 将该章节的内容，同时插入到审核表中
				// pass
			}
		}
		// 其他验证 ...

		if ($is_edit) {
			if (empty($data['ch_id'])) return z_info(-11, '章节id不允许为空');

			$vip = parent::getChapterInfo('ch_vip');
			if (empty($vip)) return z_info(-12, '章节不存在');

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