<?php
/**
 * 作者站 父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller {

	protected $authorInfo = Null; 		// 作者信息
	protected $authorInstance = Null;	// 作者对象
	
	public function __construct()
	{
		parent::__construct();
		\Zlib\Api\Acl::author();
		$this->authorInstance = D('Author', 'Service');
		$this->init();
	}

	protected function init()
	{
		$user_id = ZS('SESSION.user', 'user_id');
		$this->authorInfo = $this->authorInstance->getAuthorInfoByUserId($user_id);
		ZS('SESSION.author', Null, $this->authorInfo);
		$this->assign('author_info', $this->authorInfo);
	}
}