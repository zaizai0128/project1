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

	protected $userInstance = Null;
	public $userInfo = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = D('User', 'Service');
		$this->init();
	}

	public function init()
	{
		$this->userInfo = $this->userInstance->getUserInfoByUserId($this->userId);
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
	 * 补充用户信息
	 */
	public function doAddExt()
	{
		if (IS_POST) {
			$data = array_merge($this->userInfo, I());
			$state = $this->userInstance->doEditExt($data);

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
		$state = D('UserAuthor', 'Service')->checkUserAuthorInfo($this->userId);

		// 调到补充个人真实信息页
		if ($state['code'] <=0)
			$this->error($state['msg'], ZU('user/center/trueInfo'));

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
				$this->error($state['msg']);
			}
			$this->success($state['msg'], ZU('user/center/index'));
		}
	}

	/**
	 * 更新真实信息
	 */
	public function trueInfo()
	{
		$author_info = D('UserAuthor', 'Service')->getAuthorInfoByUserId($this->userId);

		$this->assign(array(
			'author_info' => $author_info
		));
		$this->display();
	}

	/**
	 * 补充真实信息
	 */
	public function doTrueInfo()
	{
		if (IS_POST) {
			$data = array_merge($this->userInfo, I());
			
			$state = D('UserAuthor', 'Service')->doEdit($data);

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
}