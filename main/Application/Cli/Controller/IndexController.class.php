<?php
/**
 * 命令行模式
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-10
 * @version 1.0
 */
namespace Cli\Controller;
use Think\Controller;

class IndexController extends Controller {

	public function index()
	{
		echo 'cli|index';
	}

	public function say()
	{
		echo 'cli|say';
	}

}