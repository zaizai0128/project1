<?php
/**
 * 公司信息
 *
 * @author 	wangz
 * @date     2014-10-30
 * @version  1.0
 *
 */
namespace Home\Controller;


class CompanyController extends CompanyBaseController {
	// 公司主页
	public function index()
	{
		$data['company_id'] = $this->uid;

		$company = $this->comObj->where('id = '.$this->uid)->find();
		$company['scale'] = C('company_scale')[$company['scale']];
		$company['stage'] = C('company_stage')[$company['stage']];
		
		$comTagObj = D('CompanyTag');
		$tagObj = D('Tag');
		$res = $comTagObj->where($data)->select();
		$str = '';
		if ($res) {
			foreach($res as $val) {
				$str .= $val['tag_id'].',';
			}
			$str = rtrim($str, ',');
			$where['id'] = array('in', $str);
			$tag = $tagObj->where($where)->select();
			$this->assign('tag', $tag);
		}
		$result1 = $tagObj->where('type > 0')->limit(12)->select();
		$result2 = $tagObj->where('type > 0')->limit('12,10')->select();

		$productObj = D('Product');
		$product = $productObj->where($data)->select();

		$teamObj = D('Team');
		$team = $teamObj->where($data)->select();

		$jobObj = D('Job');
		$job = $jobObj->where(array('company_id'=>$this->uid))->select();
		$jobnum = $jobObj->where(array('company_id'=>$this->uid))->count();

		$this->assign('company', $company);
		$this->assign('allTag1', $result1);
		$this->assign('allTag2', $result2);
		$this->assign('product', $product);
		$this->assign('team', $team);
		$this->assign('job', $job);
		$this->assign('jobnum', $jobnum);
		$this->display();
	}


	// 公司列表页
	public function companylist()
	{
		$this->display();
	}

	public function showCompany()
	{
		$data['company_id'] = $this->uid;

		$company = $this->comObj->where('id = '.$this->uid)->find();
		$company['scale'] = C('company_scale')[$company['scale']];
		$company['stage'] = C('company_stage')[$company['stage']];
		
		$comTagObj = D('CompanyTag');
		$tagObj = D('Tag');
		$res = $comTagObj->where($data)->select();
		$str = '';
		if ($res) {
			foreach($res as $val) {
				$str .= $val['tag_id'].',';
			}
			$str = rtrim($str, ',');
			$where['id'] = array('in', $str);
			$tag = $tagObj->where($where)->select();
			$this->assign('tag', $tag);
		}
		$result1 = $tagObj->where('type > 0')->limit(12)->select();
		$result2 = $tagObj->where('type > 0')->limit('12,10')->select();

		$productObj = D('Product');
		$product = $productObj->where($data)->select();

		$teamObj = D('Team');
		$team = $teamObj->where($data)->select();

		$jobObj = D('Job');
		$job = $jobObj->where(array('company_id'=>$this->uid))->select();
		$jobnum = $jobObj->where(array('company_id'=>$this->uid))->count();

		$this->assign('company', $company);
		$this->assign('allTag1', $result1);
		$this->assign('allTag2', $result2);
		$this->assign('product', $product);
		$this->assign('team', $team);
		$this->assign('job', $job);
		$this->assign('jobnum', $jobnum);
		$this->display();
	}
}