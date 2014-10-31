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
		$this->authorInstance = D('Author', 'Service');
		$this->init();
		\Zlib\Api\Acl::author($this->authorInfo);
	}

	protected function init()
	{
		$user_id = ZS('SESSION.user', 'user_id');

		// 判断该用户是不是管理员
		// 如果是管理员，判断该管理员对本书的权限，是否具备编辑修改的操作。

		// 如果不是管理员，则通过获取作者信息来判断。

		$this->authorInfo = $this->authorInstance->getAuthorInfoByUserId($user_id);
		ZS('SESSION.author', Null, $this->authorInfo);
		$this->assign('author_info', $this->authorInfo);
	}
}