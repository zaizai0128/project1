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
use Zlib\Api as Zapi;

class BaseController extends Controller {

	// 用户id
	protected $user_id;

	public function __construct()
	{
		parent::__construct();

		$this->_init();
	}

	protected function _init()
	{
		
	}
}