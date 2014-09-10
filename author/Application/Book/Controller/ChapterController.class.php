<?php
/**
 * 章节管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Book\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class ChapterController extends BaseController {

	/**
	 * 章节管理页面
	 */
	public function index()
	{

		$this->display();
	}
}