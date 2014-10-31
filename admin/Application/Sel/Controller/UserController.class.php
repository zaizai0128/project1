<?php
/**
 * 用户查询
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-31
 * @version 1.0
 */
namespace Sel\Controller;
use Common\Controller\BaseController;

class UserController extends BaseController {

	protected $userInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = D('User', 'Service');
	}

	/**
	 * 用户查询
	 */
	public function index()
	{
		$param['user_name'] = I('get.username');
		$param['user_email'] = I('get.email'); 
		$param['user_mobile'] = I('get.mobile');
		$param = z_array_filter($param);

		if (!empty($param)) {
			$total = $this->userInstance->getUserTotal($param);		
			$Page = new \Think\Page($total, C('ADMIN.list_size'));
			$have_page['firstRow'] = $Page->firstRow;
			$have_page['listRows'] = $Page->listRows;
			$user_list = $this->userInstance->getUserList($param, $have_page);
			$page = $Page->show();
		}
		
		$this->assign(array(
			'param' => $param,
			'user_list' => $user_list,
			'page' => $page,
		));
		$this->display();
	}

	/**
	 * 显示用户信息
	 */
	public function show()
	{
		$user_id = I('get.user_id');
		$user_info = $this->userInstance->getInfo($user_id);

		// dump($user_info);
		$this->assign('user_info', $user_info);
		$this->display();
	}


}