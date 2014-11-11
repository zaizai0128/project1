<?php
/**
 * 用户账户管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-11
 * @version 1.0
 */
namespace User\Controller;
use Common\Controller\BaseController;

class AccountController extends BaseController {

	const TYPE = 'KEFU';	// 客服类操作
	protected $userId = null;
	protected $accountInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->userId = I('get.user_id');
		$this->accountInstance = D('Account', 'Service');
	}

	/**
	 * 修改账户页面
	 */
	public function edit()
	{
		$info = $this->accountInstance->getAccountByUserId($this->userId, '*');

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 修改
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = I();
			$data['type'] = self::TYPE;

			if ($data['subtype'] == 4) {
				$state = $this->accountInstance->changeExpire($data);
			} else {
				// 调整金融信息
				$state = $this->accountInstance->changeAccount($data);
			}

			if ($state['status'] > 0)
				$state['url'] = ZU('sel/user/show', 'ZL_ADMIN_DOMAIN', array('user_id'=>$data['user_id']));

			$this->ajaxReturn($state);
		}
	}

	public function clear()
	{
		$info = $this->accountInstance->getAccountByUserId($this->userId, '*');

		$this->assign('info', $info);
		$this->display();
	}

	public function doClear()
	{
		if (IS_POST) {
			$data = I();
			$data['type'] = self::TYPE;
			$data['subtype'] = 5;
			
			$state = $this->accountInstance->clearAccount($data);

			if ($state['status'] > 0)
				$state['url'] = ZU('sel/user/show', 'ZL_ADMIN_DOMAIN', array('user_id'=>$data['user_id']));

			$this->ajaxReturn($state);
		}
	}

}