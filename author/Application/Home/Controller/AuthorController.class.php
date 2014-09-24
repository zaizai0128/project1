<?php
/**
 * 作者管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api\Author;

class AuthorController extends BaseController {

	// 作者api
	private $_author;

	protected function init()
	{
		parent::init();
		$this->_author = new Author;
	}

	/**
	 * 作者个人信息
	 */
	public function index()
	{
		// 获取作者全部信息
		$info = $this->_author->getInfo($this->user_id, True);

		$this->assign(array(
			'info' => $info
		));
		$this->display();
	}

	/**
	 * 编辑信息
	 */
	public function edit()
	{
		echo 'edit';
	}

	/**
	 * 执行编辑
	 */
	public function doEdit()
	{
		if (IS_POST) {

			dump(I());
		}
	}

	/**
	 * 填写银行信息
	 */
	public function bank()
	{
		// 获取该用户的银行信息
		$bank_info = D('AuthorBank')->getBankById($this->user_id);

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

			// 创建作者银行的服务层
			$bank_service = D('AuthorBank', 'Service');
			
			// 如果存在银行信息，则修改
			if ($bank_id = $bank_service->checkBankInfo($this->user_id)) {
				$data['id'] = $bank_id;
				$state = $bank_service->updateBankInfo($data);

			// 否则添加一条新数据
			} else {
				$data['user_id'] = $this->user_id;
				$state = $bank_service->updateBankInfo($data, False);
			}

			if ($state['code'] > 0)
				z_redirect($state['msg'], ZU('author/bank', 'ZL_AUTHOR_DOMAIN'));
			else
				z_redirect($state['msg']);
		}
	}
}