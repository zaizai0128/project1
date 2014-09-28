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

	protected $user_id;
	protected $adminInfo;

	public function __construct()
	{
		parent::__construct();
		$this->adminInfo = ZS('SESSION.admin');
		\Zlib\Api\Acl::admin($this->adminInfo);
	}
}