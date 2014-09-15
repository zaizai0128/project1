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

	private $_apply_obj;			// 请求作品对象
	private $_apply_chapter_obj; 	// 请求作品的章节对象
	private $_book_id;				// 请求作品id
	private $_book_info;			// 该作品的信息

	protected function _init()
	{
		parent::_init();

		$this->_apply_obj = D('BookApply');
		$this->_apply_chapter_obj = D('BookApplyChapter');
		$this->_book_id = I('get.bk_apply_id');
		$this->checkBookApplyAcl($this->_book_id);
		$this->_book_info = $this->_apply_obj->getInfo($this->_book_id);
	}

	/**
	 * 章节列表
	 */
	public function index()
	{
		$size = 10;
		$total = $this->_apply_chapter_obj->getTotal($this->_book_id);
		$Page = new \Think\Page($total, $size);
		$show = $Page->show();
		$chapter = $this->_apply_chapter_obj->getList($this->_book_id, $Page->firstRow, $Page->listRows);

		$this->assign(array(
			'book' => $this->_book_info,
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
			'book' => $this->_book_info,
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
			$data['bk_id'] = $this->_book_id;

			// 验证提交的章节是否通过
			$state = D('BookApplyChapter', 'Service')->checkChapter($data);

			if ($state['code'] < 0) {
				$this->error($state['msg']);
			}

			// 上传新章节
			$rs = $this->_apply_chapter_obj->doAdd($data);

			if ($rs > 0) {

				$data['ch_id'] = $rs;
				$tag['data'] = $data;
				$tag['ac'] = 'after_add';	// 行为名称
				tag('apply_chapter', $tag);	// 章节上传成功后，更新对应的数据表信息
				
				$this->success('添加成功，审核通过后才会看到', ZU('bookApply/book', 'ZL_AUTHOR_DOMAIN', array('bk_apply_id'=>$this->_book_id)));
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

		$chapter = $this->_apply_chapter_obj->getInfo($ch_id);

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
		$data['bk_id'] = $this->_book_id;

		// 验证提交的章节是否通过
		$state = D('BookApplyChapter', 'Service')->checkChapter($data, False);

		if ($state['code'] < 0) {
			$this->error($state['msg']);
		}

		// 修改章节
		$rs = $this->_apply_chapter_obj->doEdit($data);

		if ($rs > 0) {

			// 修改章节后，需要对该本书进行更新么?
			// $tag['data'] = $data;
			// $tag['ac'] = 'after_edit';	// 行为名称
			// tag('apply_chapter', $tag);	// 章节编辑成功后，更新对应的数据表信息

			$this->success('修改成功，审核通过后才会看到', ZU('bookApply/book', 'ZL_AUTHOR_DOMAIN', array('bk_apply_id'=>$this->_book_id)));
		} else {

			$this->error('修改失败，重新尝试');
		}
	}
}