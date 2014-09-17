<?php
/**
 * 作者银行信息
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-17
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class AuthorBankModel extends BaseModel {

	protected $trueTableName = 'zl_user_author_bank';

	/**
	 * 获取作者的银行信息
	 *
	 * @param int 用户id
	 */
	public function getBankById($user_id)
	{
		return $this->where('user_id = '.$user_id)->find();
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
			$rs = $this->data($info)->save();
		else 
			$rs = $this->data($info)->add();

		return $rs > 0 ? array('code'=>1, 'msg'=>'成功') : array('code'=>-1, 'msg'=>'失败');
	}
}