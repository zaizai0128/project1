<?php
/**
 * 待审核作品章节管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Controller;

class BookApplyChapterController extends HomeController {

	protected $bookId = Null;
	protected $chapterId = Null;
	protected $bookApplyInstance = Null;
	protected $chapterInstance = Null;

	protected function init()
	{
		parent::init();
		$this->bookId = I('get.apply_id');
		$this->chapterId = I('get.ch_id');
		\Zlib\Api\Acl::apply($this->authorInfo, $this->bookId);
		$this->bookApplyInstance = D('BookApply', 'Service');
		$this->chapterInstance = D('BookApplyChapter', 'Service');

		// 作品信息
		$book_info = $this->bookApplyInstance
					->getOneApplyBook($this->authorInfo['user_id'], $this->bookId, 'bk_name,bk_id');
		$chapter = $this->chapterInstance->getChapterList($this->bookId);
		$assign['total'] = count($chapter);

		$this->assign(array(
			'assign' => $assign,
			'book_info' => $book_info,
			'chapter' => $chapter,
			'ch_id' => $this->chapterId,
		));
	}

	/**
	 * 章节列表
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 上传新章节
	 */
	public function add()
	{
		$this->display();
	}

	/**
	 * 执行上传新章节
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data = array_merge($this->authorInfo, I(), array('bk_id'=>$this->bookId));
			$state = $this->chapterInstance->doAddApplyChapter($data);

			if ($state['code'] > 0) {
				$data['ch_id'] = $state['code'];
				$tag['data'] = $data;
				$tag['ac'] = 'after_add';	// 行为名称
				tag('apply_chapter', $tag);	// 章节上传成功后，更新对应的数据表信息
				
				z_redirect('添加成功，审核通过后才会看到', ZU('bookApplyChapter/index', 'ZL_AUTHOR_DOMAIN'
								, array('apply_id'=>$this->bookId)));
			} else {
				z_redirect('添加失败，重新尝试');
			}
		}
	}

	/**
	 * 修改章节
	 */
	public function edit()
	{
		$chapter_info = $this->chapterInstance->getChapterInfo($this->bookId, $this->chapterId);

		$this->assign(array(
			'chapter_info' => $chapter_info,
		));
		$this->display();
	}

	/**
	 * 执行修改章节
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = array_merge($this->authorInfo, I(), array('bk_id'=>$this->bookId, 'ch_id'=>$this->chapterId));
			$state = $this->chapterInstance->doEditApplyChapter($data);

			if ($state['code'] >0) {
				$tag['data'] = $data;
				$tag['ac'] = 'after_edit';	// 行为名称
				tag('apply_chapter', $tag);	// 章节上传成功后，更新对应的数据表信息

				z_redirect('修改成功，审核通过后才会看到', ZU('bookApplyChapter/index', 'ZL_AUTHOR_DOMAIN'
							, array('apply_id'=>$this->bookId)));
			} else {
				z_redirect('修改失败，重新尝试');
			}
		}
	}
}