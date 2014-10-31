<?php
/**
 * 后台管理员管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */

namespace Home\Controller;
use Common\Controller\BaseController;

class UserController extends BaseController {

	protected $adminInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->adminInstance = D('Admin', 'Service');
	}
	
	public function index()
	{


		$this->display();
	}

	/**
	 * 添加管理员
	 */
	public function add()
	{

		$this->display();
	}

	/**
	 * 执行添加管理员
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->adminInstance->doRegister($data);

			if ($state['status'] > 0) {
				$state['url'] = ZU('user/index', 'ZL_ADMIN_DOMAIN');
			}
			$this->ajaxReturn($state);
		}
	}

}
