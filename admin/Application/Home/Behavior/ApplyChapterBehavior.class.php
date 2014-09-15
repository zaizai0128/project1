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
		$book_apply = M('zl_book_apply');
		$rs = $book_apply->where('bk_id = '.$this->data['bk_id'])->find();

		if (!$rs)
			return False;

		// 获取章节的信息
		$chapter_info = M('zl_book_apply_chapter')->where('ch_id = '.$this->data['ch_id'])->find();

		// 保存章节更新时间
		$book_apply->bk_now_date = $chapter_info['ch_update'];
		$book_apply->bk_public_name = $chapter_info['ch_name'];
		$book_apply->bk_public_ch_id = $chapter_info['ch_id'];
		$book_apply->ch_total += 1;
		$book_apply->save();
	}

	/**
	 * 编辑章节后的操作
	 */
	protected function afterEdit()
	{
		$book_apply = M('zl_book_apply');
		$rs = $book_apply->where('bk_id = '.$this->data['bk_id'])->find();

		if (!$rs)
			return False;

		// 获取章节的信息
		$chapter_info = M('zl_book_apply_chapter')->where('ch_id = '.$this->data['ch_id'])->find();

		// 保存章节更新时间
		$book_apply->bk_now_date = $chapter_info['ch_update'];
		$book_apply->bk_public_name = $chapter_info['ch_name'];
		$book_apply->save();
	}

}