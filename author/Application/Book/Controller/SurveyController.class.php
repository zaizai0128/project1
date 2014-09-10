<?php
/**
 * 调查管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Book\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class SurveyController extends BaseController {

	/**
	 * 调查管理页面
	 */
	public function index()
	{

		$this->display();
	}

	/**
	 * 创建调查问卷
	 */
	public function doAdd()
	{
		if (IS_POST) {

			dump(I());
		}
	}

}