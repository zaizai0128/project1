<?php
/**
 * 章节审核
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-04
 * @version 1.0
 */
namespace Check\Controller;
use Common\Controller\BaseController;

class ChapterController extends BaseController {

	protected $auditInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->auditInstance = D('ChapterAudit', 'Service');
	}

	/**
	 * 审核列表
	 */
	public function index()
	{	
		$total = $this->auditInstance->getTotal();
		$Page = new \Think\Page($total, C('ADMIN.list_size'));
		$have_page['firstRow'] = $Page->firstRow;
		$have_page['listRows'] = $Page->listRows;
		$data = $this->auditInstance->getList('', $have_page);

		$this->assign(array(
			'data' => $data,
			'page' => $Page->show(),
		));
		$this->display();
	}

	/**
	 * 审核内容
	 */
	public function check()
	{
		$id = I('get.id');
		$data = $this->auditInstance->getCheckInfo($id);
		
		// dump($data);
		$this->assign('data', $data);
		$this->display();
	}

	/**
	 * 审核
	 */
	public function doCheck()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->auditInstance->setChapterStatus($data);

			if ($state['status'] > 0) {
				$state['url'] = ZU('check/Chapter/index', 'ZL_ADMIN_DOMAIN' );
			}
			$this->ajaxReturn($state);	
		}
	}

	/**
	 * 解封作品
	 */
	public function doUnlock()
	{
		$id = I('get.id');



	}

}