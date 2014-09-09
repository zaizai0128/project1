<?php
/**
 * 用户中心controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace User\Controller;
use Zlib\Api as Zapi;

class CenterController extends UserController {

	protected $_user;

	public function __construct()
	{
		parent::__construct();

		$this->_user = new Zapi\User;
		$this->_author = new Zapi\Author;
		$this->_init();
	}

	public function _init()
	{

		$info = $this->_user->getInfo(session('user.user_id'));
		$this->assign(array(
			'info' => $info
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
	 * 补充用户信息
	 */
	public function doAddExt()
	{
		if (IS_POST) {

			$state = $this->_user->updateExt(I());

			if ($state['code'] > 0)
				$this->success($state['msg'], U('user/center/index')); 
			else
				$this->error($state['msg']);
		}
	}

	/**
	 * 申请成为作者
	 */
	public function apply()
	{
		$full_info = array();
		$assign['is_show'] = True;

		// 获取申请信息
		$info = $this->_author->getApplyById(session('user.user_id'));

		// 如果没有申请作者的信息，则显示申请界面
		if (empty($info)) {
			$full_info = $this->_user->getInfo(session('user.user_id'), True);

		// 否则显示申请进度
		} else {
			$assign['is_show'] = False;
			$full_info = $info;
		}
		
		$this->assign(array(
			'assign' => $assign,
			'full_info' => $full_info,
		));
		$this->display();
	}

	/**
	 * 执行成为作者
	 */
	public function doApply()
	{
		if (IS_POST) {
			
			if (!$this->_user->checkTrueInfo(session('user.user_id')))
				$this->error('请先补充个人真实信息', U('user/center/trueInfo'));

			$state = $this->_author->apply(I());
			
			if ($state['code'] > 0) 
				$this->success($state['msg'], U('user/center/index'));
			else 
				$this->error($state['msg']);
		}
	}

	/**
	 * 更新真实信息
	 */
	public function trueInfo()
	{	
		$true_info = $this->_user->getTrueInfo(session('user.user_id'));

		$this->assign(array(
			'true_info' => $true_info
		));
		$this->display();
	}

	/**
	 * 补充真实信息
	 */
	public function doTrueInfo()
	{
		if (IS_POST) {

			if ($this->_user->checkTrueInfo(session('user.user_id')))
				$state = $this->_user->updateTrueInfo(I());
			else 
				$state = $this->_user->updateTrueInfo(I(), False);

			if ($state['code'] > 0)
				$this->success($state['msg'], U('user/center/index'));
			else
				$this->error($state['msg']);
		}
	}

	/**
	 * 填写银行信息
	 */
	public function bank()
	{
		$bank_info = $this->_user->getBankById(session('user.user_id'));

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

			if ($this->_user->checkBankInfo(session('user.user_id'))) 
				$state = $this->_user->updateBankInfo(I());
			else
				$state = $this->_user->updateBankInfo(I(), False);

			if ($state['code'] > 0)
				$this->success($state['msg'], U('user/center/index'));
			else
				$this->error($state['msg']);
		}
	}

	/**
	 * 升级成为vip
	 */
	public function vip()
	{

		$this->display();
	}

	/**
	 * 执行成为vip
	 */
	public function doVip()
	{
		if (IS_POST) {

			dump(I());
		}
	}

	/**
	 * 用户退出
	 */
	public function logout()
	{
		$state = $this->_user->logout();		
		$this->success('退出成功', U('/index/index'));
	}
}