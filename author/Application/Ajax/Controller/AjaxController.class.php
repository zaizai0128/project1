<?php
/**
 * ajax 父类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Ajax\Controller;
use Think\Controller;

class AjaxController extends Controller {

	public function __construct()
	{
		parent::__construct();

		// 禁止ajax以外访问
		if (!IS_AJAX) E('页面错误', 404);
	}

}