<?php
/**
 * 待审核作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class BookApplyController extends BaseController {

	protected $bookApplyInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->bookApplyInstance = D('BookApply', 'Service');
	}

	/**
	 * 待审核作品列表
	 */
	public function index()
	{
		$total = $this->bookApplyInstance->getTotal();
		$size = C('ADMIN.apply_list_size');
		$Page = new \Think\Page($total, $size);
		$show = $Page->show();
		$book_apply = $this->bookApplyInstance->getApplyList('', $Page->firstRow, $Page->listRows);

		$this->assign(array(
			'book_apply' => $book_apply,
			'page' => $show,
		));
		$this->display();
	}
	
	/**
	 * 审核界面
	 */
	public function check()
	{
		$book_id = I('get.apply_id');
		$book = $this->bookApplyInstance->getApplyBookByBookId($book_id, 'bk_id, bk_name');

		$this->assign(array(
			'book' => $book,
		));
		$this->display();
	}

	/**
	 * 执行审核
	 */
	public function doCheck()
	{
		if (IS_POST) {

			if (I('bk_apply_status') == '00') {
				z_redirect('请选择审核状态');
			}
					
			$data = I();
			$data['bk_apply_user'] = $this->adminInfo['user_id'];
			$data['bk_apply_name'] = $this->adminInfo['user_name'];
			$state = $this->bookApplyInstance->doEdit($data);

			if ($state > 0) {

				// 如果审核通过
				if ($data['bk_apply_status'] == '01') {
					
					// 修改成功，执行的行为
					$tag['data'] = $data;
					$tag['ac'] = 'after_check_allow';	// 行为名称
					tag('book_apply', $tag);	// 审核通过或失败后，更新对应的数据表信息
				}

				z_redirect('修改成功', ZU('bookApply/index', 'ZL_ADMIN_DOMAIN'));
			} else {
				z_redirect('修改失败');
			}
		}
	}
}