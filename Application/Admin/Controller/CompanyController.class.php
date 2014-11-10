<?php
/**
 * 公司列表
 *
 * @author 	wangz
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Admin\Controller;

class CompanyController extends BaseController {

	protected $companyObj = null;

	public function __construct()
	{
		parent::__construct();
		$this->companyObj = M('Company');
	}

	public function index()
	{
		$map = I();
		$where = array_filter($map);
		if (isset($where['name']))
			$where['name'] = array('LIKE', '%'.$where['name'].'%');

		$total = $this->companyObj->where($where)->count();
		$Page = new \Think\Page($total, 20);
		$data = $this->companyObj->where($where)->limit($Page->firstRow, $Page->listRows)->select();
		
		$this->assign('map', $map);
		$this->assign('data', $data);
		$this->display();
	}


}