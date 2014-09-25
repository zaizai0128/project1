<?php
/**
 * 申请作品的章节 行为类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-12
 * @version 1.0
 */
namespace Home\Behavior;

class ApplyChapterBehavior {

	protected $data = Null;
	protected $ac = Null;
	protected $bookApplyInstance = Null;
	protected $chapterInstance = Null;

	public function __construct()
	{
		$this->bookApplyInstance = D('BookApply', 'Service');
		$this->chapterInstance = D('BookApplyChapter', 'Service');
	}

	/**
	 * 行为入口程序
	 */
	public function run(&$params)
	{
		$this->ac = $params['ac'];
		$this->data = $params['data'];

		switch ($this->ac) {

			// 添加申请作品的章节以后
			case 'after_add' :
				$this->afterAdd();
				break;

			case 'after_edit' :
				$this->afterEdit();
				break;
		}
	}

	/**
	 * 添加章节后的操作
	 */
	protected function afterAdd()
	{
		$chapter_info = $this->chapterInstance->getChapterInfo($this->data['bk_id'], $this->data['ch_id']);

		$final_data['bk_now_date'] = $chapter_info['ch_update'];
		$final_data['bk_public_name'] = $chapter_info['ch_name'];
		$final_data['bk_public_ch_id'] = $chapter_info['ch_id'];
		$final_data['ch_total'] = $this->chapterInstance->getTotalChapterNum($this->data['bk_id']);
		$final_data['bk_id'] = $chapter_info['bk_id'];
		$final_data['bk_size'] = $this->chapterInstance->getTotalSizeChapter($this->data['bk_id']);
		
		$this->bookApplyInstance->doEdit($final_data);
	}

	/**
	 * 编辑章节后的操作
	 */
	protected function afterEdit()
	{
		$chapter_info = $this->chapterInstance->getChapterInfo($this->data['bk_id'], $this->data['ch_id']);

		$final_data['bk_id'] = $this->data['bk_id'];
		$final_data['bk_size'] = $this->chapterInstance->getTotalSizeChapter($this->data['bk_id']);
		
		$this->bookApplyInstance->doEdit($final_data);
	}

}