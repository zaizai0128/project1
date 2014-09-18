<?php
/**
 * 待审核作品章节管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class BookApplyChapterController extends BaseController {

	protected $apply_obj;			// 请求作品对象
	protected $apply_chapter_obj; 	// 请求作品的章节对象
	protected $book_id;				// 请求作品id
	protected $book_info;			// 该作品的信息

	protected function init()
	{
		parent::init();

		$this->book_apply_obj = D('BookApply', 'Service');
		$this->apply_chapter_obj = D('BookApplyChapter', 'Service');
		$this->book_id = I('get.bk_apply_id');
		$this->checkBookApplyAcl($this->book_id);
		$this->book_info = $this->book_apply_obj->getApplyInfo($this->book_id);
	}

	/**
	 * 章节列表
	 */
	public function index()
	{
		$size = C('APPLY.max_chapter_num');
		$total = $this->apply_chapter_obj->getTotal($this->book_id);
		$Page = new \Think\Page($total, $size);
		$show = $Page->show();
		$chapter = $this->apply_chapter_obj->getList($this->book_id, $Page->firstRow, $Page->listRows);

		$this->assign(array(
			'book' => $this->book_info,
			'chapter' => $chapter,
			'page' => $show
		));
		$this->display();
	}

	/**
	 * 上传新章节
	 */
	public function createNewChapter()
	{

		$this->assign(array(
			'book' => $this->book_info,
		));
		$this->display();
	}

	/**
	 * 执行上传新章节
	 */
	public function doCreateNewChapter()
	{
		if (IS_POST) {
			$data = I();
			$data['bk_id'] = $this->book_id;

			// 验证提交的章节是否通过
			$state = $this->apply_chapter_obj->checkChapter($data);

			if ($state['code'] < 0) {
				$this->error($state['msg']);
			}

			// 获取最后一个ch_order
			$data['ch_order'] = $this->apply_chapter_obj->getLastChapterOrder($this->book_id);
			
			// 上传新章节
			$rs = $this->apply_chapter_obj->doAdd($data);

			if ($rs > 0) {

				$data['ch_id'] = $rs;
				$tag['data'] = $data;
				$tag['ac'] = 'after_add';	// 行为名称
				tag('apply_chapter', $tag);	// 章节上传成功后，更新对应的数据表信息
				
				$this->success('添加成功，审核通过后才会看到', ZU('bookApply/book', 'ZL_AUTHOR_DOMAIN'
								, array('bk_apply_id'=>$this->book_id)));
			} else {
				$this->error('添加失败，重新尝试');
			}
		}
	}

	/**
	 * 修改章节
	 */
	public function edit()
	{
		$ch_id = I('get.ch_id');
		$chapter = $this->apply_chapter_obj->getApplyChapterInfo($this->book_id, $ch_id);

		$this->assign(array(
			'chapter' => $chapter,
		));
		$this->display();
	}

	/**
	 * 执行修改章节
	 */
	public function doEdit()
	{
		$data = I();
		$data['bk_id'] = $this->book_id;

		// 验证提交的章节是否通过
		$state = $this->apply_chapter_obj->checkChapter($data, False);

		if ($state['code'] < 0) {
			$this->error($state['msg']);
		}

		// 修改章节
		$rs = $this->apply_chapter_obj->doEdit($data);

		if ($rs > 0) {

			// 修改章节后，需要对该本书进行更新么?
			// $tag['data'] = $data;
			// $tag['ac'] = 'after_edit';	// 行为名称
			// tag('apply_chapter', $tag);	// 章节编辑成功后，更新对应的数据表信息

			$this->success('修改成功，审核通过后才会看到', ZU('bookApply/book', 'ZL_AUTHOR_DOMAIN'
							, array('bk_apply_id'=>$this->book_id)));
		} else {
			$this->error('修改失败，重新尝试');
		}
	}
}