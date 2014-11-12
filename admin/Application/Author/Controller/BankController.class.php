<?php
/**
 * 作者银行信息
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-12
 * @version 1.0
 */
namespace Author\Controller;
use Common\Controller\BaseController;

class BankController extends BaseController {

	protected $userId = null;
	protected $authorInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->userId = I('get.user_id');
		$this->authorInstance = D('Author', 'Service');
	}

	/**
	 * 银行信息
	 */
	public function edit()
	{
		$info = $this->authorInstance->getBankByUserId($this->userId);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 保存银行卡
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->authorInstance->editBank($data);

			if ($state['status'] > 0)
				$state['url'] = ZU('author/index/show', 'ZL_ADMIN_DOMAIN', array('user_id'=>$data['user_id']));

			$this->ajaxReturn($state);
		}
	}
}