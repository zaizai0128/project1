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
			$data = I();
			$data['user_id'] = session('user.user_id');
			$state = $this->_user->updateExt($data);

			if ($state['code'] > 0)
				$this->success($state['msg'], ZU('user/center/index')); 
			else
				$this->error($state['msg']);
		}
	}

	/**
	 * 申请成为作者
	 */
	public function apply()
	{	
		// 判断是否需要补充个人真实信息
		if (!$this->_author->checkTrueInfo(session('user.user_id')))
			$this->error('请先补充个人真实信息', ZU('user/center/trueInfo'));

		$full_info = array();
		$assign['is_show'] = True;

		// 获取申请信息
		$info = $this->_author->getApplyById(session('user.user_id'));

		// 如果没有申请作者的信息，则显示申请界面
		if (empty($info)) {

			// 获取作者的全部信息[包含真实信息]
			$full_info = $this->_author->getInfo(session('user.user_id'), True);

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

			$info = $this->_author->getApplyById(session('user.user_id'));
			if (!empty($info)) {
				$this->error('您已经提交了申请，正在审核阶段', ZU('user/center/apply'));
			}

			$data = I();
			$data['user_id'] = session('user.user_id');
			$state = $this->_author->apply($data);
			
			if ($state['code'] > 0) 
				$this->success($state['msg'], ZU('user/center/index'));
			else 
				$this->error($state['msg']);
		}
	}

	/**
	 * 更新真实信息
	 */
	public function trueInfo()
	{	
		$true_info = $this->_author->getTrueInfo(session('user.user_id'));

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
			$data = I();
			$data['user_id'] = session('user.user_id');
			
			// 编辑
			if ($this->_author->checkTrueInfo(session('user.user_id'))) {
				$state = $this->_author->updateTrueInfo($data);

			// 创建 
			} else {
				$state = $this->_author->updateTrueInfo($data, False);
			}

			if ($state['code'] > 0)
				$this->success($state['msg'], ZU('user/center/index'));
			else
				$this->error($state['msg']);
		}
	}

	/**
	 * 填写银行信息
	 */
	public function bank()
	{
		$bank_info = $this->_author->getBankById(session('user.user_id'));

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
			$data = I();

			if ($id = $this->_author->checkBankInfo(session('user.user_id'))) {
				$data['id'] = $id;
				$state = $this->_author->updateBankInfo($data);
			} else {
				$data['user_id'] = session('user.user_id');
				$state = $this->_author->updateBankInfo($data, False);
			}

			if ($state['code'] > 0)
				$this->success($state['msg'], ZU('user/center/index'));
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
		$this->success('退出成功', ZU('/index/index'));
	}
}