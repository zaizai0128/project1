<?php
/**
 * 作品管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Book\Controller;
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
	 * 作品管理
	 */
	public function index()
	{
		
		echo 'book manager';
	}

	/**
	 * 新建作品
	 */
	public function create()
	{
		$auth_info = $this->_author->getInfo(session('user.user_id'), True);
		
		$this->assign(array(
			'auth_info' => $auth_info
		));
		$this->display();
	}

	/**
	 * 提交新建作品
	 */
	public function doCreate()
	{
		if (IS_POST) {

			dump(I());
		}
	}

	/**
	 * 新建作品说明
	 */
	public function createHelp()
	{
		$content = file_get_contents('http://www.zhulang.com/htmpage/zpschuan.html');
		$this->show($content);
	}
	
}