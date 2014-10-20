<?php
/**
 * 后台管理站 父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Common\Controller;
use Think\Controller;

class BaseController extends Controller {

	protected $userId = Null;
	protected $adminInfo = Null;
	protected $adminInstance = Null;
	protected $gcid = Null;	// 公共的分类id

	public function __construct()
	{
		parent::__construct();
		$this->adminInstance = D('Admin', 'Service');
		$this->userId = ZS('SESSION.admin', 'user_id');
		$this->adminInfo = $this->adminInstance->getAdminInfo($htis->userId);
		\Zlib\Api\Acl::admin($this->adminInfo);
		$this->gcid = I('get.gcid');
		// 获取后台网站的导航
		$menu = D('Menu', 'Service')->getMenu($this->gcid);
		$this->assign('menu_category', $menu);
		$this->assign('global_cid', $this->gcid);
	}
}