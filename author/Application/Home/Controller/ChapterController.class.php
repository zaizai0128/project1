<?php
/**
 * 章节管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;

class ChapterController extends HomeController {

	protected $bookId = Null;
	protected $chapterId = Null;
	protected $bookInstance = Null;
	protected $chapterInstance = Null;
	protected $volumeInstance = Null;

	public function init()
	{
		parent::init();
		$this->bookId = I('get.book_id');
		$this->chapterId = I('get.ch_id');
		\Zlib\Api\Acl::check($this->authorInfo, $this->bookId);
		$this->bookInstance = D('Book', 'Service');
		$this->chapterInstance = D('Chapter', 'Service')->getInstance($this->bookId, $this->chapterId);
		$this->volumeInstance = D('Volume', 'Service');
	}

	/**
	 * 章节管理页面
	 */
	public function index()
	{
		$book_info = $this->bookInstance->getBookByBookId($this->bookId, 'bk_id,bk_name');
		$chapter_list = \Zlib\Api\Book::getCatalog($this->bookId);
		$this->assign(array(
			'chapter_list' => $chapter_list,
			'book_info' => $book_info,
		));
		$this->display();
	}

	/**
	 * 添加新的章节
	 */
	public function add()
	{	
		$book_info = $this->bookInstance->getBookByBookId($this->bookId, 'bk_id,bk_name');
		$volume_list = $this->volumeInstance->getVolumeList($this->bookId, False);
		$this->assign(array(
			'volume_list' => $volume_list,
			'book_info' => $book_info,
		));
		$this->display();
	}

	/**
	 * 执行添加新的章节
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data = array_merge($this->authorInfo, I(), array('bk_id'=>$this->bookId));
			$state = $this->chapterInstance->doAdd($data);

			if ($state['code'] > 0) {
				$data['ch_id'] = $state['code'];
				$tag['data'] = $data;
				$tag['ac'] = 'after_add';	// 行为名称
				tag('chapter', $tag);	// 章节上传成功后，更新对应的数据表信息

				z_redirect('添加成功', ZU('chapter/index', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$this->bookId)));
			} else {
				z_redirect('添加失败');
			}
		}
	}

	/**
	 * 章节修改
	 */
	public function edit()
	{
		$chapter_info = $this->chapterInstance->getChapterInfo();

		if (empty($chapter_info)) z_redirect('章节不存在'); 

		$this->assign(array(
			'chapter_info' => $chapter_info,
		));
		$this->display();
	}

	/**
	 * 执行章节修改
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = array_merge($this->authorInfo, I(), array('bk_id'=>$this->bookId, 'ch_id'=>$this->chapterId));
			$state = $this->chapterInstance->doEdit($data);

			if ($state['code'] > 0) {
				$tag['data'] = $data;
				$tag['ac'] = 'after_edit';	// 行为名称
				tag('chapter', $tag);		// 章节修改成功后，更新对应的数据表信息
				
				z_redirect('修改成功', ZU('chapter/index', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$this->bookId)));
			} else {
				z_redirect('修改失败');
			}
		}
	}

	/**
	 * 调卷
	 */
	public function editVolume()
	{
		$chapter_info = $this->chapterInstance->getChapterInfo();
		$volume_list = $this->volumeInstance->getVolumeList($this->bookId, False);

		$this->assign(array(
			'volume_list' => $volume_list,
			'chapter_info' => $chapter_info,
		));
		$this->display();
	}

	public function doEditVolume()
	{
		if (IS_POST) {
			$data = array_merge($this->authorInfo, I(), array('bk_id'=>$this->bookId,'ch_id'=>$this->chapterId));

			$state = $this->chapterInstance->doEditBookVolume($data);
			
			if ($state['code'] > 0) {

				z_redirect('修改成功', ZU('chapter/index', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$this->bookId)));
			} else {
				z_redirect('修改失败');
			}
		}
	}
}