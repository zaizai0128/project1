<?php
/**
 * 用户管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-11
 * @version 1.0
 */
namespace User\Controller;
use Common\Controller\BaseController;

class IndexController extends BaseController {

	protected $userId = null;
	protected $userInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->userId = I('get.user_id');
		$this->userInstance = D('User', 'Service');
	}

	/**
	 * 重置密码
	 */
	public function pwd()
	{
		$this->assign('user_id', $this->userId);
		$this->display();
	}

	/**
	 * 
	 */
	public function doPwd()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->userInstance->resetPwd($data);

			if ($state['status'] > 0)
				$state['url'] = ZU('sel/user/show', 'ZL_ADMIN_DOMAIN', array('user_id'=>$data['user_id']));

			$this->ajaxReturn($state);
		}
	}


}