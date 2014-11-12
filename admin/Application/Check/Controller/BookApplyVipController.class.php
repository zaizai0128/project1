<?php
/**
 * 申请成为vip 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Check\Controller;
use Common\Controller\BaseController;

class BookApplyVipController extends BaseController {

	protected $bookId = Null;
	protected $vipInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->vipInstance = D('BookApplyVip', 'Service');
	}

	/**
	 * 列表页
	 */
	public function index()
	{
		$total = $this->vipInstance->getTotal();
		$limit = C('ADMIN.list_size');
		$Page = new \Think\Page($total, $limit);
		$show = $Page->show();
		$vip_list = $this->vipInstance->getList($Page->firstRow, $Page->listsRows);

		$this->assign(array(
			'vip_list' => $vip_list,
			'page' => $show,
		));
		$this->display();	
	}

	/**
	 * 审核
	 */
	public function check()
	{
		$vip_info = $this->vipInstance->getInfoByBookId($this->bookId);

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
			$state = $this->vipInstance->doEdit($data);
			
			if ($state['status'] <=0) 
				$this->ajaxReturn($state);

			// 如果审核通过 执行动作
			$tag = array();
			$tag['ac'] = 'after_check_allow';	
			$tag['data'] = $data;
			tag('book_apply_vip', $tag);

			$state['url'] = ZU('check/BookApplyVip/index', 'ZL_ADMIN_DOMAIN');
			$this->ajaxReturn($state);
		}
	}
}