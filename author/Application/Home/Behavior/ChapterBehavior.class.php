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

	protected $data;
	protected $ac;

	/**
	 * 行为入口程序
	 */
	public function run(&$params)
	{
		$this->ac = $params['ac'];
		$this->data = $params['data'];

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
		$chapter = D('Chapter', 'Service')->init($this->data['bk_id']);
		$chapter_info = $chapter->getChapterInfo($this->data['ch_id']);

		// 更新book表数据
		$book = M('zl_book');
		$rs = $book->where('bk_id = '.$this->data['bk_id'])->find();
		
		if (!$rs) return False;

		// 如果是vip则更新vip章节
		if ($chapter_info['ch_vip'] == 1) {
			$book->bk_vip_name = $chapter_info['ch_name'];
			$book->bk_vip_ch_id = $chapter_info['ch_id'];
		} else {
			$book->bk_public_name = $chapter_info['ch_name'];
			$book->bk_public_ch_id = $chapter_info['ch_id'];
		}
		$book->bk_now_date = $chapter_info['ch_update'];
		$book->ch_total += 1;
		$book->save();
	}
}