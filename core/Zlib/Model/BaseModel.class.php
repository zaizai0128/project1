<?php
/**
 * 公共Model类
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Model;
use Think\Model;

class BaseModel extends Model {

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}
	
	protected function init()
	{

	}

	/**
	 * 调试方法，打印上一条sql
	 */
	public function debug()
	{
		dump($this->getLastSql());
		die;
	}

}
