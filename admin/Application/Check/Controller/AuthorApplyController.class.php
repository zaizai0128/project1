<?php
/**
 * 作者申请
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-24
 * @version 1.0
 */
namespace Check\Controller;
use Common\Controller\BaseController;

class AuthorApplyController extends BaseController {

	protected $id = Null;
	protected $applyInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->id = I('get.id');
		$this->applyInstance = D('AuthorApply', 'Service');
	}

	/**
	 * 列表
	 */
	public function index()
	{
		// 获取申请总数
		$total = $this->applyInstance->getApplyTotal();
		$Page = new \Think\Page($total, C('ADMIN.list_size'));
		$pages['firstRow'] = $Page->firstRow;
		$pages['listRows'] = $Page->listRows;
		$list = $this->applyInstance->getApplyList('*', $pages);

		$this->assign(array(
			'apply_list' => $list,
		));
		$this->display();
	}

	/**
	 * 审核页面
	 */
	public function check()
	{
		$apply_info = $this->applyInstance->getApplyInfo($this->id);

		$this->assign(array(
			'apply_info' => $apply_info,
		));
		$this->display();
	}

	/**
	 * 执行审核
	 */
	public function doCheck()
	{
		if (IS_POST) {
			$data = array_merge(I(), $this->adminInfo);
			$state = $this->applyInstance->doCheckApply($data);

			if ($state['status'] > 0) {

				$state['url'] = ZU('check/authorApply/index', 'ZL_ADMIN_DOMAIN');
				$this->ajaxReturn($state);
			}
			$this->ajaxReturn($state);
		}
	}



}