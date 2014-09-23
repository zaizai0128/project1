<?php
/**
 * 申请作品的行为类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Behavior;
use Zlib\Api as Zapi;

class BookApplyBehavior {

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

			// 作品审核通过后执行的动作
			case 'after_check_allow' :
				$this->afterCheckAllow();
				break;
		}
	}

	/**
	 * 审核通过以后
	 */
	public function afterCheckAllow()
	{
		$book = array();

		// 获取审核书籍的信息
		$book_apply = D('BookApply')->getInfo($this->data['bk_id']);

		// 审核通过的作品数据
		$book['bk_site'] = $book_apply['bk_site'];
		$book['bk_cre_time'] = $book_apply['bk_cre_time'];
		$book['bk_name'] = $book_apply['bk_name'];
		$book['bk_author_id'] = $book_apply['bk_author_id'];
		$book['bk_author'] = $book_apply['bk_author'];
		$book['bk_poster_id'] = $book_apply['bk_author_id'];
		$book['bk_poster'] = $book_apply['bk_author'];
		$book['bk_actor'] = $book_apply['bk_actor'];
		$book['bk_tag'] = $book_apply['bk_tag'];
		$book['bk_initial'] = ''; // 作品的首字母 ， 通过程序获取，暂时搁置
		$book['bk_size'] = $book_apply['bk_size'];
		$book['bk_intro'] = $book_apply['bk_intro'];
		$book['bk_now_date'] = $book_apply['bk_now_date'];
		$book['bk_class_id'] = $book_apply['bk_class_id'];
		$book['bk_accredit'] = $book_apply['bk_accredit'];
		$book['bk_commision'] = $book_apply['bk_commision'];
		$book['ch_total'] = $book_apply['ch_total'];

		$book_obj = D('Book');

		// 创建新的作品
		$book_id = $book_obj->createNewBook($book);

		if ($book_id <= 0)
			return False;

		// 创建章节对象
		$chapter_obj = D('Chapter')->init($book_id);

		// 获取该书的审核章节
		$book_chapters = D('BookApplyChapter')->getChapterList($this->data['bk_id']);
		
		// 更新章节到正式表
		foreach ($book_chapters as $key => $val) {
			$val['ch_poster_id'] = $book_apply['bk_author_id'];
			$val['ch_poster'] = $book_apply['bk_author'];
			$val['bk_id'] = $book_id;
			$val['ch_roll'] = C('BOOK.start_volume');
			$chapter_obj->createChapter($val);
		}

		// 获取该书的最后更新的一个章节
		$rs = $chapter_obj->getLastChapter($book_id);
		$chapter['bk_id'] = $book_id;
		$chapter['bk_public_name'] = $rs['ch_name'];
		$chapter['bk_public_ch_id'] = $rs['ch_id'];

		// 更新该书的最后更新章节
		$book_obj->editBookLastChapter($chapter);
	}

}