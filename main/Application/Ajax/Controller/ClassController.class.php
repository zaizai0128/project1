<?php
/**
 * 分类 ajax
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-29
 * @version 1.0
 */
namespace Ajax\Controller;
use Zlib\Api\BookClass;

class ClassController extends AjaxController {

	protected $classInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->classInstance = BookClass::getInstance();
	}

	/**
	 * 获取喜欢的小说类型
	 */
	public function getLikeTag()
	{
		$class = $this->classInstance->getAllClassForJson();
		$this->ajaxReturn($class);
	}


}