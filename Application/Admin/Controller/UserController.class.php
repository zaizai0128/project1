<?php
/**
 * 用户管理
 *
 * @author 	wangz
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Admin\Controller;

class UserController extends BaseController {

	/**
	 * 用户列表页
	 */
	public function index()
	{
		$users = D('users');
		$result = $users->select();
		$state = array('个人用户', '企业用户', '个人企业用户', '禁用');
		$this->assign('arr', $result);
		$this->assign('vip', $state);
		$this->display();
	}

	public function edit()
	{
		$users = D('users');
		$user = I();
		$result = $users->where('id =' .$user['id'])->select();
		$this->assign('arr', $result);
		$this->display();
	}

	/**
	 * 用户信息修改操作
	 */
	public function doEdit()
	{
		$users = D('users');
		$user = I();
		$result = $users->where('id='.$user['id'])->save($user);

		if ($result) {
			$this->success('修改成功', U('user/index'), 4);
		}
		// // 判断是否是post提交
		// if (IS_POST) {
		// 	// 获取post传过来的数据
		// 	$data = I();

		// 	// 进行验证,修改等操作

		// 	// 返回的是一个数组
		// 	$state['status'] = 1;
		// 	$state['msg'] = '修改成功';
		// 	$state['url'] = U('user/index');// 成功跳转的地址

		// 	// 失败
		// 	// $state['status'] = 0;
		// 	// $state['msg'] = '错误原因xxxx';
			
		// 	// tp自带的返回ajax方式
		// 	$this->ajaxReturn($state);
		// }
	}
}