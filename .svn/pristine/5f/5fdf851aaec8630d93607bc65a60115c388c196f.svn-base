<?php
namespace Home\Controller;
use Think\Controller;
class CollectionJobController extends Controller {
	//收藏职位的遍历显示
	public function index(){
		$id = 1;
		$user_col=M('user_col');
		$job=M('job');
		$res_user_col=$user_col->where("uid={$id}")->select();
		if($res_user_col){
			foreach ($res_user_col as $value) {
				$res_job=$job->where("id={$value['job_id']}")->find();
				if($res_job){
					$data[]=$res_job;
				}
   			}
		}
		$this->assign('data',$data);
		$this->display();
	}
	//收藏职位的删除

}