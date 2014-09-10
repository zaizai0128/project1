<?php
/**
 * 公共的作者api接口
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.1
 */
namespace Zlib\Api;

class Author extends User {

	/**
	 * 获取用户信息
	 * @override 重写夫方法
	 *
	 * @param  uid 	 用户id
	 * @param  Boolean 是否获取全部信息
	 * @return array 用户信息
	 */
	public function getInfo($uid, $full = False)
	{
		$base_info = $this->where('user_id = '.$uid)->find();
		$true_info = array();

		if ($full)
			$true_info = $this->getTrueInfo($uid);

		return array_merge($base_info, $true_info);
	}

	/**
	 * 申请成为作者
	 *
	 * @param Array 申请资料
	 */
	public function apply($info)
	{
		if (empty($info['user_true_name']))
			return array('code'=>-1, 'msg'=>'姓名不能为空');

		if (empty($info['aa_text']))
			return array('code'=>-21, 'msg'=>'你需要写点什么');

		$info['aa_date'] = date('Y-m-d H:i:s', time());

		$rs = M('zl_user_author_apply')->data($info)->add();

		if ($rs > 0)
			return array('code' => 1, 'msg' => '申请成功');
		else 
			return array('code' => 0, 'msg' => '申请失败');

	}

	/**
	 * 获取用户的真实信息
	 *
	 * @param uid 用户id
	 */
	public function getTrueInfo($uid)
	{
		return M('zl_user_author')->where('user_id = '.$uid)->find();
	}

	/**
	 * 判断用户真实信息是否通过
	 *
	 * @param uid 用户id
	 */
	public function checkTrueInfo($uid)
	{
		$info = M('zl_user_author')->field('user_id')->where('user_id = '.$uid)->find();
		return empty($info) ? False : True;
	}

	/**
	 * 补充用户的真实信息
	 *
	 * @param array 保存信息
	 * @param boolean 编辑/添加
	 */
	public function updateTrueInfo($info, $is_edit = True)
	{
		if ($is_edit)
			$rs = M('zl_user_author')->data($info)->save();
		else
			$rs = M('zl_user_author')->data($info)->add();

		return $rs > 0 ? array('code'=>1, 'msg'=>'成功') : array('code'=>-1, 'msg'=>'失败');
	}

	/**
	 * 获取作者申请信息
	 *
	 * @param int 用户id
	 */
	public function getApplyById($user_id)
	{
		return M('zl_user_author_apply')->where('user_id = '.$user_id)->find();
	}

	/**
	 * 获取用户银行卡信息
	 *
	 * @param int 用户id
	 */
	public function getBankById($uid)
	{
		return M('zl_user_author_bank')->where('user_id = '.$uid)->find();
	}

	/**
	 * 验证银行卡信息
	 * @param int 用户id
	 * @return boolean | int
	 */
	public function checkBankInfo($uid)
	{
		$info = M('zl_user_author_bank')->field('id')->where('user_id = '.$uid)->find();
		return empty($info) ? False : $info['id'];
	}

	/**
	 * 保存银行卡信息
	 *
	 * @param Array 银行卡信息
	 * @param Boolean 是否是更新
	 */
	public function updateBankInfo($info, $is_edit = True)
	{
		if ($is_edit)
			$rs = M('zl_user_author_bank')->data($info)->save();
		else 
			$rs = M('zl_user_author_bank')->data($info)->add();

		return $rs > 0 ? array('code'=>1, 'msg'=>'成功') : array('code'=>-1, 'msg'=>'失败');
	}

}