<?php
/**
 * 章节管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class ChapterController extends BaseController {

	protected $book_obj;	
	protected $book_id;		// 书籍id 
	protected $book_info;	// 书籍信息
	protected $chapter_obj;

	public function init()
	{
		parent::init();

		$this->book_obj = D('Book', 'Service');
		$this->book_id = I('get.book_id');
		$this->checkChapterAcl();
		$this->book_info = $this->book_obj->getBookInfo($this->book_id);
		$this->chapter_obj = D('Chapter', 'Service')->init($this->book_id);
	}

	/**
	 * 章节管理页面
	 */
	public function index()
	{
		$book_api = new Zapi\Book($this->book_id);
		$chapter_list = $book_api->getCatalog();

		$this->assign(array(
			'chapter_list' => $chapter_list,
			'book_info' => $this->book_info,
		));
		$this->display();
	}

	/**
	 * 添加新的章节
	 */
	public function newChapter()
	{	
		$volume_obj = D('Volume', 'Service');
		$volume_list = $volume_obj->getVolumeList($this->book_id, False);


		$this->assign(array(
			'volume_list' => $volume_list,
			'book_info' => $this->book_info,
		));
		$this->display();
	}

	/**
	 * 执行添加新的章节
	 */
	public function doNewChapter()
	{
		if (IS_POST) {
			$data = I();
			$data['bk_id'] = $this->book_id;
			$state = $this->chapter_obj->checkChapter($data);

			if ($state['code'] < 0) {
				$this->error($state['msg']);
			}
			$last_id = $this->chapter_obj->createNewChapter($data);

			if ($last_id) {
				$data['ch_id'] = $last_id;
				$tag['data'] = $data;
				$tag['ac'] = 'after_add';	// 行为名称
				tag('chapter', $tag);	// 章节上传成功后，更新对应的数据表信息

				$this->success('添加成功', ZU('chapter/index', 'ZL_AUTHOR_DOMAIN', array('book_id'=>$this->book_id)));
			} else {
				$this->error('添加失败');
			}
		}
	}
}