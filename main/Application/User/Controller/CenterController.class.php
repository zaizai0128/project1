<?php
/**
 * 用户中心 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace User\Controller;

class CenterController extends UserController {

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function init()
	{
		$this->userInfo = $this->userInstance->getUserInfo($this->userId);
		$this->assign(array(
			'user_info' => $this->userInfo,
		));
	}

	/**
	 * 用户中心center首页
	 */
	public function index()
	{
		$this->display();
	}
	
	/**
	 * 申请成为作者
	 */
	public function apply()
	{	
		// 判断是否需要补充个人真实信息
		$state = D('UserAuthor', 'Service')->checkUserAuthorInfo($this->userId);

		// 跳到补充个人真实信息页
		if ($state['code'] <=0)
			z_redirect($state['msg'], ZU('user/center/trueInfo'));

		// 获取个人申请信息
		$info = $this->userInstance->getApplyInfoByUserId($this->userId);

		// 判断显示申请界面还是进度界面
		$assign['is_show'] = True;
		// 如果没有个人信息，则读取个人全部信息，并显示申请界面
		if (empty($info))
			$info = $this->userInstance->getUserFullInfoByUserId($this->userId);
		else
			$assign['is_show'] = False;

		$this->assign(array(
			'assign' => $assign,
			'full_info' => $info,
		));
		$this->display();
	}

	/**
	 * 执行成为作者
	 */
	public function doApply()
	{
		if (IS_POST) {
			$data = array_merge($this->userInfo, I());
			$state = $this->userInstance->doAddApply($data);

			if ($state['code'] <=0 ) {
				z_redirect($state['msg']);
			}
			z_redirect($state['msg'], ZU('user/center/index'));
		}
	}
}