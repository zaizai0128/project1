<?php
/**
 * 作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Book\Controller;
use Common\Controller\BaseController;

class IndexController extends BaseController {

	protected $bookInstance = Null;

	public function __construct()
	{
		parent::__construct();

		$this->bookInstance = D('Book', 'Service');
	}

	public function index()
	{
		// 搜索条件
		$param['bk_name'] = array('like', '%'.I('get.bk_name').'%');
		$param['bk_author'] = I('get.bk_author');
		$param['bk_status'] = I('get.bk_status');
		$param['bk_fullflag'] = I('get.bk_fullflag');
		$param = z_array_filter($param, False);

		$class = \Zlib\Api\BookClass::getInstance()->getClass();
		$assign['class'] = $class;

		$total = $this->bookInstance->getBookTotal($param);
		$Page = new \Think\Page($total, C('ADMIN.list_size'));
		$have_page['firstRow'] = $Page->firstRow;
		$have_page['listRows'] = $Page->listRows;
		$book_list = $this->bookInstance->getBookList($param, $have_page);

		$param['bk_name'] = I('get.bk_name');
		$this->assign(array(
			'param' => $param,
			'assign' => $assign,
			'page' =>  $Page->show(),
			'book_list' => $book_list,
		));
		$this->display();
	}

	/**
	 * 详情编辑
	 */
	public function edit()
	{
		$class = \Zlib\Api\BookClass::getInstance()->getClass();
		$assign['class'] = $class;

		$book_id = I('get.book_id');
		$book_info = $this->bookInstance->getBookByBookId($book_id);

		$this->assign('assign', $assign);
		$this->assign('book_info', $book_info);
		$this->display();
	}

	public function doEdit()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->bookInstance->doEditInfo($data);
			$state['url'] = ZU('book/index/edit', 'ZL_ADMIN_DOMAIN', array('book_id'=>$data['bk_id']));
			$this->ajaxReturn($state);
		}
	}

}