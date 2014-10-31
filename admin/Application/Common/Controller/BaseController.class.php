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

	public function __construct()
	{
		parent::__construct();
		$this->adminInstance = D('Admin', 'Service');
		$this->userId = ZS('SESSION.admin', 'user_id');
		$info = $this->adminInstance->getUserInfoById($this->userId);
		$this->adminInfo = array_merge(ZS('SESSION.admin'), (array)$info);
		\Zlib\Api\Acl::admin($this->adminInfo);
		$this->assign('admin_info', $this->adminInfo);
	}
}