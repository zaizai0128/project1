<?php
/**
 * 后台的基类
 *
 * @author 	wangz
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {

	public function __construct()
	{
		parent::__construct();

		if (!SESSION('?admin')) {
			$this->error('请先登录', U('Admin/Login/login'));
		}
	}

}