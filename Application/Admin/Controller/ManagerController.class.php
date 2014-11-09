<?php
/**
 * 管理员列表
 *
 * @author 	wangz
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Admin\Controller;

class ManagerController extends BaseController {

	protected $adminObj = null;

	public function __construct()
	{
		parent::__construct();
		$this->adminObj = M('Admin');
	}

	/**
	 * 列表
	 */
	public function index()
	{
		$total = $this->adminObj->count();
		$Page = new \Think\Page($total, 20);
		$data = $this->adminObj->limit($Page->first, $Page->listRows)->order('id desc')->select();

		$this->assign('data', $data);
		$this->assign('page', $Page->show());
		$this->display();
	}

	public function add()
	{

		$this->display();
	}

	public function doAdd()
	{
		if (IS_POST) {
			$data = I();
			$data['password'] = md5($data['password']);
			$data['create_time'] = time();
			$id = $this->adminObj->data($data)->add();

			if ($id) {
				$msg['code'] = 1;
				$msg['msg'] = '添加成功';
			} else {
				$msg['code'] = 0;
				$msg['msg'] = '添加失败';
			}
			
			$this->ajaxReturn($msg);
		}
	}

	public function pic()
	{
		$user_id = I('post.user_id');
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =    3145728 ;// 设置附件上传大小    
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath  =      './Admin/Manager/Pic/'; // 设置附件上传目录
		$upload->saveName = (string)$user_id;
		$upload->saveExt = 'jpeg';
		$upload->subName = "";
		$upload->replace = true;
		$upload->hash = false;
		$info = $upload->upload();

		if (!$info)
		{
			$msg['code'] = 0;
			$msg['msg'] = $upload->getError();
		} else {
			$msg['code'] = 1;
			$msg['msg'] = '上传成功';
			$msg['url'] = '/Uploads/Admin/Manager/Pic/'.$info['pic']['savename'];
		}
		
		$this->ajaxReturn($msg);
	}
}