<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
	public function index(){
		var_dump($_GET);
		//进行薪资搜索判断
		if(!empty($_GET['salary'])){
			switch($_GET['salary']){
				case '2k以下':
					$_SESSION['search']['salary_low']=array(array('egt',0),array('elt',2));
					break; 
				case '2k-5k':
					$_SESSION['search']['salary_low']=array(array('egt',0),array('elt',2));
					break;
				case '5k-10k':
					$_SESSION['search']['salary_low']=5;
					$_SESSION['search']['salary_high']=10;
					break;
				case '10k-15k':
					$_SESSION['search']['salary_low']=10;
					$_SESSION['search']['salary_high']=15;
					break;
				case '15k-25k':
					$_SESSION['search']['salary_low']=15;
					$_SESSION['search']['salary_high']=25;
					break;
				case '25k-50k':
					$_SESSION['search']['salary_low']=25;
					$_SESSION['search']['salary_high']=50;
					break;
				case '50k以上':
					$_SESSION['search']['salary_low']=50;
					$_SESSION['search']['salary_high']=50;
					break;
			}
		}
		//进行工作经验判断
		if(!empty($_GET['workyear'])){
			$_SESSION['search']['work_year']=$_GET['workyear'];
		}
		//进行工作地点判断
		if(!empty($_GET['address'])){
			$_SESSION['search']['city']=$_GET['address'];
		}
		//学历搜索条件
		if(!empty($_GET['edu'])){
			$_SESSION['search']['edu']=$_GET['edu'];
		}
		//是否全职
		if(!empty($_GET['nature'])){
			$_SESSION['search']['nature']=$_GET['nature'];
		}
		//职业判断
		if(!empty($_GET['job'])){			
			$_SESSION['search']['name']=array('like',"%{$_GET['job']}%");
		}
		var_dump($_SESSION['search']);
		$job = M('job');
		$a = $_SESSION['search'];
		$res_job = $job->where($a)->select();
		echo $job->getLastSql();
		$this->display();
	}
	public function pages(){
		$job = M('job');
		$count = $job->count();
		$Page = new \Think\Page($count,1);
		$Page->setConfig('first','首页');
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('last','尾页');
		$show = $Page->show();
		$res_job=$job->select();
		$this->assign('data',$res_job);
		$this->assign('page',$show);
		$this->display();
	}
	//按月薪搜索
	public function salarySearch(){

	}
	//按职位搜索
	public function jobSearch(){

	}
	//按公司搜索
	public function companySearch(){

	}
	//按地点搜索
	public function addressSearch(){

	}
	//按工作经验搜索
	public function experienceSearch(){

	}
	//按最低学历搜索
	public function eduSearch(){

	}
	//按工作性质
	public function natureSearch(){

	}
	//按发布时间搜索
	public function timeSearch(){

	}
}