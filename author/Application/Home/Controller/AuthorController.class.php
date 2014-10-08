<?php
/**
 * 作者管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;

class AuthorController extends HomeController {

	/**
	 * 作者个人信息
	 */
	public function index()
	{
		$this->assign(array(
			'author_info' => $this->authorInfo,
		));
		$this->display();
	}

	/**
	 * 填写银行信息
	 */
	public function bank()
	{
		// 获取该用户的银行信息
		$bank_info = D('UserAuthorBank', 'Service')->getBankInfoByUserId($this->authorInfo['user_id']);

		$this->assign(array(
			'bank_info' => $bank_info,
		));
		$this->display();
	}

	/**
	 * 保存银行信息
	 */
	public function doBank()
	{
		if (IS_POST) {
			$data = array_merge($this->authorInfo, I());
			// 保存银行信息
			$state = D('UserAuthorBank', 'Service')->doAddBank($data);

			if ($state['code'] > 0)
				z_redirect($state['msg'], ZU('author/bank', 'ZL_AUTHOR_DOMAIN'));
			else
				z_redirect($state['msg']);
		}
	}
}