<?php
/**
 * 作品封面审核
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-04
 * @version 1.0
 */
namespace Check\Controller;
use Common\Controller\BaseController;

class BookCoverController extends BaseController {

	protected $auditInstance = null;
	const TYPE = 2;

	public function __construct()
	{
		parent::__construct();
		$this->auditInstance = D('Audit', 'Service');
		$this->auditInstance->setType(self::TYPE);
	}

	/**
	 * 作品封面待审核列表
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
	 * 审核页面
	 */
	public function check()
	{
		$id = I('get.id');
		$data = $this->auditInstance->getInfo($id, 'id,audit_content');
		$data['bk_info'] = z_json_decode($data['audit_content']);
		$this->assign('data', $data);
		$this->display();
	}

	/**
	 * 执行审核
	 */
	public function doCheck()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->auditInstance->setBookCoverStatus($data);

			if ($state['status'] > 0) {
				$state['url'] = ZU('check/BookCover/index', 'ZL_ADMIN_DOMAIN' );
			}
			$this->ajaxReturn($state);	
		}
	}
}