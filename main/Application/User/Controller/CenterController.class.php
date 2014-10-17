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

	/**
	 * 用户中心center首页
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 判断是显示申请作者，还是跳到作者专区
	 */
	public function area()
	{
		// 如果是作者，则直接跳到作者专区
		if (in_array($this->userInfo['user_type'], array('02', '03'))) {
			z_redirect('登录成功', ZU('index/index', 'ZL_AUTHOR_DOMAIN'));
			return;
		}

		// 获取个人申请信息
		$apply_info = $this->userInstance->getApplyInfoByUserId($this->userId);
		
		$this->assign(array(
			'apply_info' => $apply_info,
		));
		$this->display();
	}

	/**
	 * 申请成为作者
	 */
	public function apply()
	{	
		$this->display();
	}

	/**
	 * 执行成为作者
	 */
	public function doApply()
	{
		if (IS_POST) {
			$data = array_merge($this->userInfo, I(), array('user_id'=>$this->userId));
			$state = $this->userInstance->doAddApply($data);

			if ($state['code'] <=0 ) {
				z_redirect($state['msg']);
			}
			z_redirect($state['msg'], ZU('user/center/area'));
		}
	}

	/**
	 * 修改申请信息
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = array_merge($this->userInfo, I(), array('user_id'=>$this->userId));
			$state = $this->userInstance->doEditApply($data);

			if ($state['code'] <=0 ) {
				z_redirect($state['msg']);
			}
			z_redirect($state['msg'], ZU('user/center/area'));
		}
	}
}