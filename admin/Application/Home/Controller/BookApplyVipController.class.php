<?php
/**
 * 申请成为vip 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;

class BookApplyVipController extends BaseController {

	protected $bookId = Null;
	protected $instance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->instance = D('BookApplyVip', 'Service');
	}

	/**
	 * 列表页
	 */
	public function index()
	{
		$total = $this->instance->getTotal();
		$limit = 10;
		$Page = new \Think\Page($total, $limit);
		$show = $Page->show();
		$vip_list = $this->instance->getList($Page->firstRow, $Page->listsRows);

		$this->assign(array(
			'data' => $vip_list,
			'page' => $show,
		));
		$this->display();	
	}

	/**
	 * 审核
	 */
	public function check()
	{
		$vip_info = $this->instance->getInfoByBookId($this->bookId);

		$this->assign(array(
			'data' => $vip_info,
		));
		$this->display();
	}

	/**
	 * 执行审核
	 */
	public function doCheck()
	{
		if (IS_POST) {
			$data = I();
			$data = array_merge($data, $this->adminInfo);
			$state = $this->instance->doEdit($data);

			if ($state['code'] <=0) z_redirect($state['msg']);

			// 如果审核通过 执行动作
			$tag = array();
			$tag['ac'] = 'after_check_allow';	
			$tag['data'] = $data;
			tag('book_apply_vip', $tag);

			z_redirect('修改成功', ZU('BookApplyVip/index', 'ZL_ADMIN_DOMAIN'));
		}
	}
}