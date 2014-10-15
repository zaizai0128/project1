<?php
/**
 * controller 基类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace InterfaceApi\Controller;
use Think\Controller;

class InterfaceApiController extends Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
}