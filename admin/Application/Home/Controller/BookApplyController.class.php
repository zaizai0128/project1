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

	protected $_book_apply;

	protected function _init()
	{
		parent::_init();
		$this->_book_apply = D('BookApply');
	}

	/**
	 * 待审核作品列表
	 */
	public function index()
	{
		$total = $this->_book_apply->getTotal();
		$limit = 10;
		$Page = new \Think\Page($total, $limit);
		$show = $Page->show();
		$book_apply = $this->_book_apply->getApplyList('', $Page->firstRow, $Page->listRows);

		$this->assign(array(
			'book_apply' => $book_apply,
			'page' => $show,
		));
		$this->display();
	}
	
	/**
	 * 审核界面
	 *
	 */
	public function check()
	{
		$book_id = I('get.bk_apply_id');
		$book = $this->_book_apply->getInfo($book_id);

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
				$this->error('请选择审核状态');
			}

			$data = I();
			$data['bk_apply_user'] = session('user.user_id');
			$data['bk_apply_name'] = session('user.user_name');
			$state = $this->_book_apply->doEdit($data);

			if ($state > 0) {

				// 如果审核通过
				if ($data['bk_apply_status'] == '01') {
					
					// 修改成功，执行的行为
					$tag['data'] = $data;
					$tag['ac'] = 'after_check_allow';	// 行为名称
					tag('book_apply', $tag);	// 审核通过或失败后，更新对应的数据表信息
				}

				$this->success('修改成功', ZU('bookApply/index', 'ZL_ADMIN_DOMAIN'));
			} else {
				$this->error('修改失败');
			}
		}
	}

}