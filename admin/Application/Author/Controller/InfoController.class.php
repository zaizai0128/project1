<?php
/**
 * 作者信息康
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-12
 * @version 1.0
 */
namespace Author\Controller;
use Common\Controller\BaseController;

class InfoController extends BaseController {

	protected $userId = null;
	protected $authorInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->userId = I('get.user_id');
		$this->authorInstance = D('Author', 'Service');
	}

	/**
	 * 责任编辑
	 */
	public function assignEditor()
	{
		$info = $this->authorInstance->getAuthorInfoByUserId($this->userId);

		// 获取责任编辑
		$info['manager_name'] = $this->authorInstance->getEditorNameByUserId($info['manager_id']);
		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 修改责任编辑
	 */
	public function doAssignEditor()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->authorInstance->editAssignEditor($data);

			if ($state['status'] > 0)
				$state['url'] = ZU('author/index/show', 'ZL_ADMIN_DOMAIN', array('user_id'=>$data['user_id']));

			$this->ajaxReturn($state);
		}
	}

	/**
	 * 修改签约信息 , 作者信息
	 */
	public function authorInfo()
	{
		$info = $this->authorInstance->getAuthorInfoByUserId($this->userId);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 执行修改签约信息
	 */
	public function doAuthorInfo()
	{
		if (IS_POST) {
			$data = I();

			$state = $this->authorInstance->editCommisionInfo($data);

			if ($state['status'] > 0)
				$state['url'] = ZU('author/index/show', 'ZL_ADMIN_DOMAIN', array('user_id'=>$data['user_id']));

			$this->ajaxReturn($state);
		}
	}
}