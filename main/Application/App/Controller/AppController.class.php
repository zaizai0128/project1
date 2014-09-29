<?php
/**
 * 应用分组的父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-29
 * @version 1.0
 */
namespace App\Controller;
use Think\Controller;

class AppController extends Controller {

	protected $userId = Null;
	protected $userInfo = Null;

	public function __construct()
	{
		parent::__construct();
		$this->userId = ZS('SESSION.user', 'user_id');
		$this->userInfo = ZS('SESSION.user');
		\Zlib\Api\Acl::app($this->userInfo);
	}

}