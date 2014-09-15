<?php
/**
 * 分卷管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class VolumeController extends BaseController {

	/**
	 * 分卷管理页面
	 */
	public function index()
	{
		
		$this->display();
	}

	/**
	 * 新增分卷
	 */
	public function add()
	{

	}

	/**
	 * 执行新增
	 */
	public function doAdd()
	{
		if (IS_POST) {

		}	
	}

	/**
	 * 修改分卷
	 */
	public function edit()
	{
		
	}

	/**
	 * 执行修改分卷
	 */
	public function doEdit()
	{
		if (IS_POST) {

		}
	}

	/**
	 * 删除分卷
	 */
	public function delete()
	{
		if (IS_POST) {

		}
	}

}