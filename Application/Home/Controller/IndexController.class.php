<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

	public function tmp2()
	{

		$msg['content']['data']['phone'] = '18612666432';
		$msg['content']['data']['email'] = '247678652@qq.com';
		$msg['content']['rows'] = [];
		$msg['message'] = '操作成功';
		$msg['state'] = 1;

		$this->ajaxReturn($msg);
		// echo '{"content":{"data":{"phone":"18612666432","email":"247678652@qq.com"},"rows":[]},"message":"操作成功","state":1}';
	}

	//首页的显示遍历
	public function index(){
		//显示首页用户名
		$user=M('users');
		$id=session('user.id');
		$res_user=$user->where("id=$id")->find();
		if($res_user){
			$this->data['username']=$res_user['username'];
		}
		//显示首页的职位分类
		$job_category=M('job_category');
		$res_category=$this->getCates();
		//显示热门职位的分类
		$res_hotjob=$this->showHot();
		//输出到模板
		$this->assign('data',$this->data);
		$this->assign('cates',$res_category);
		$this->assign('hotjob',$res_hotjob);
		$this->display();
		//var_dump($res_category);
	}
    //最新职位的显示
    public function newjob_ajax(){
    	
    }
    //遍历数组的子分类
    public function getCates($pid=0){
        $cate = M('job_category');
        $cates = $cate->where("pid=".$pid)->select();
        //遍历分类
        $arr = array();
        if($cates){
	        foreach ($cates as $key => $value) {
	            // var_dump($value['id']);
	            $temp['id'] = $value['id'];
	            $temp['name'] = $value['name'];
	            $temp['pid']=$value['pid'];
	            //递归获取子集分类
	            $temp['sub'] = $this->getCates($temp['id']);
	            $arr[] = $temp; 
	        }
	        return $arr;      	
        }
    }
    //遍历显示热门职位
    public function showHot(){
    	$user_col = M('user_col');
    	$job = M('job');
    	$company = M('company');
    	$res_user_col=$user_col->query("select job_id,count(job_id) as times from lg_user_col GROUP BY job_id order by times desc limit 3");
    	foreach($res_user_col as $key=>$value){
    		$id=$value['job_id'];
    		$arr=$job->where("id={$id}")->find();
    		$cid=$arr['company_id'];
    		$arr['company']=$company->where("id={$cid}")->find();
    		$hot_job[]=$arr;
    	}
    	//var_dump($hot_job);
    	return $hot_job;
    }

}
