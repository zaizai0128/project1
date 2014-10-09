<?php
/**
 * 问卷调查管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-09
 * @version 1.0
 */
namespace Home\Controller;

class SurveyController extends HomeController {

	protected $bookId = Null;
	protected $bookInstance = Null;
	protected $surveyInstance = Null;

	protected function init()
	{
		parent::init();
		$this->bookId = I('get.book_id');

	}

	public function index()
	{

		$this->display();
	}

}