<?php
/**
 * 公共的作者api接口
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class Author extends Zmodel\BaseModel {

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
	 * 获取作者申请信息
	 *
	 * @param int 用户id
	 */
	public function getApplyById($user_id)
	{
		return M('zl_user_author_apply')->where('user_id = '.$user_id)->find();
	}

}