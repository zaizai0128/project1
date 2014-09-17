<?php
/**
 * 作者银行信息 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-17
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\AuthorBankModel;

class AuthorBankService extends AuthorBankModel {

	/**
	 * 验证银行卡信息
	 * @param int 用户id
	 * @return boolean | int
	 */
	public function checkBankInfo($user_id)
	{
		$info = $this->field('id')->where('user_id = '.$user_id)->find();
		return empty($info) ? False : $info['id'];
	}
}