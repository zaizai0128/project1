<?php
/**
 * 章节 行为类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-12
 * @version 1.0
 */
namespace Home\Behavior;

class ChapterBehavior {

	protected $data = Null;
	protected $ac = Null;
	protected $bookInstance = Null;
	protected $chapterInstance = Null;

	public function __construct()
	{
		$this->bookInstance = D('Book', 'Service');
		$this->chapterInstance = D('Chapter', 'Service');
	}

	/**
	 * 行为入口程序
	 */
	public function run(&$params)
	{
		$this->ac = $params['ac'];
		$this->data = $params['data'];
		$this->chapterInstance = $this->chapterInstance->getInstance($this->data['bk_id'], $this->data['ch_id']);

		switch ($this->ac) {

			// 添加后的动作
			case 'after_add' :
				$this->afterAdd();
				break;

			// 修改后的动作
			case 'after_edit' :
				$this->afterEdit();
				break;
		}
	}

	/**
	 * 添加后的操作
	 */
	protected function afterAdd()
	{
		// 获取章节的信息
		$chapter_info = $this->chapterInstance->getChapterInfo();

		// 如果是vip则更新vip章节
		if ($chapter_info['ch_vip'] == 1) {
			$final_data['bk_vip_name'] = $chapter_info['ch_name'];
			$final_data['bk_vip_ch_id'] = $chapter_info['ch_id'];
		} else {
			$final_data['bk_public_name'] = $chapter_info['ch_name'];
			$final_data['bk_public_ch_id'] = $chapter_info['ch_id'];
		}
		$final_data['bk_now_date'] = $chapter_info['ch_update'];
		$final_data['ch_total'] = $this->chapterInstance->getTotalChapterNum();
		$final_data['bk_size'] = $this->chapterInstance->getTotalSizeChapter();
		$final_data['bk_id'] = $chapter_info['bk_id'];
		$this->bookInstance->doEdit($final_data);
	}

	/**
	 * 修改章节后的操作
	 */
	protected function afterEdit()
	{
		$chapter_info = $this->chapterInstance->getChapterInfo();

		$final_data['bk_size'] = $this->chapterInstance->getTotalSizeChapter();
		$final_data['bk_id'] = $chapter_info['bk_id'];
		$this->bookInstance->doEdit($final_data);
	}
}