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

	protected $_author;

	public function __construct()
	{
		parent::__construct();

		$this->_author = new Author;
	}

	/**
	 * 作者个人信息
	 */
	public function index()
	{
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
	 * 填写银行信息
	 */
	public function bank()
	{
		$bank_info = $this->_author->getBankById($this->user_id);

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

			// 如果存在银行信息，则修改
			if ($id = $this->_author->checkBankInfo($this->user_id)) {
				$data['id'] = $id;
				$state = $this->_author->updateBankInfo($data);

			// 否则添加一条新数据
			} else {
				$data['user_id'] = $this->user_id;
				$state = $this->_author->updateBankInfo($data, False);
			}

			if ($state['code'] > 0)
				$this->success($state['msg'], ZU('index/index', 'ZL_AUTHOR_DOMAIN', array('book_id'=>I('get.book_id'))));
			else
				$this->error($state['msg']);
		}
	}
	
}