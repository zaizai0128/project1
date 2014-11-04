<?php
/**
 * 作品封笔审核
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-04
 * @version 1.0
 */
namespace Check\Controller;
use Common\Controller\BaseController;

class BookCloseController extends BaseController {

	protected $auditInstance = null;
	const TYPE = 7;

	public function __construct()
	{
		parent::__construct();
		$this->auditInstance = D('Audit', 'Service');
		$this->auditInstance->setType(self::TYPE);
	}

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

	public function check()
	{
		$id = I('get.id');
		$data = $this->auditInstance->getInfo($id, 'id,audit_content');
		$data['bk_info'] = z_json_decode($data['audit_content']);

		$this->assign('data', $data);
		$this->display();
	}

	public function doCheck()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->auditInstance->setBookCloseStatus($data);
			
			if ($state['status'] > 0) {
				$state['url'] = ZU('check/BookClose/index', 'ZL_ADMIN_DOMAIN' );
			}
			$this->ajaxReturn($state);	
		}
	}
}