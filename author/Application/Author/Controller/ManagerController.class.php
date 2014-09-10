<?php
/**
 * 作者管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Author\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;


class ManagerController extends BaseController {

	protected $_author;

	public function __construct()
	{
		parent::__construct();

		$this->_author = new Zapi\Author;
	}

	/**
	 * 作者个人信息
	 */
	public function index()
	{
		$info = $this->_author -> getInfo(session('user.user_id'), True);
		
		$this->assign(array(
			'info' => $info
		));
		$this->display();
	}
	
}