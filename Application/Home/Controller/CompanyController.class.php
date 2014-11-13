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
use Home\Model;


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
		$jobObj = D('Job');
		$tagModel = D('Tag');
		$res = $this->comObj->select();
		foreach ($res as &$val) {
			$res2 = $tagModel->getList($val['id']);
			$res3 = $jobObj->where(array('company_id'=>$val['id']))->limit(4)->select();
			$val['tag'] = $res2;
			$val['job'] = $res3;
		}

		$tradeObj = D('Trade');
		$trade = $tradeObj->select();

		$this->assign('trade', $trade);
		$this->assign('company', $res);
		$this->display();
	}

	// 公司筛选功能
	public function search()
	{
		$data = I();
		if ($data['city'] == '全国') {
			$where['city'] == '';
		} else {
			$where['city'] = $data['city'];
		}
		$where['stage'] = array_flip(C('company_stage'))[$data['fs']];
		$where['trade'] = array('like', '%'.$data['ifs'].'%');
		$where = array_filter($where);

		$jobObj = D('Job');
		$tagModel = D('Tag');
		$res = $this->comObj->where($where)->select();
		foreach ($res as &$val) {
			$res2 = $tagModel->getList($val['id']);
			$res3 = $jobObj->where(array('company_id'=>$val['id']))->limit(4)->select();
			$val['tag'] = $res2;
			$val['job'] = $res3;
		}

		$tradeObj = D('Trade');
		$trade = $tradeObj->select();
		$this->assign('trade', $trade);
		$this->assign('company', $res);
		$this->display();
	}

	// 公司展示页
	public function showCompany()
	{
		$tmp = I();
		$data['company_id'] = $tmp['id'];
		$company = $this->comObj->where($tmp)->find();
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