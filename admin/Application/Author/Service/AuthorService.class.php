<?php


namespace Author\Service;
use \Zlib\Model\ZlibUserAuthorModel;
use \Zlib\Model\ZlibUserAuthorBankModel;

class AuthorService extends ZlibUserAuthorModel {
	
	/**
	 * 修改责任编辑
	 */
	public function editAssignEditor($data)
	{
		$user_id = $data['user_id'];
		$manager_name = $data['manager_name'];

		if (empty($manager_name)) return z_ajax_info(-1, '编辑名不允许为空');
		$info = parent::getEditorByUserName($manager_name);

		if (empty($info)) return z_ajax_info(-2, '编辑不存在');

		// 判断用户状态，如果不是编辑，则提示非编辑。。用户表中，编辑的状态未定。。故该验证待定

		$editor['user_id'] = $user_id;
		$editor['manager_id'] = $info['user_id'];

		$res = parent::doEdit($editor);
		return $res ? z_ajax_info(1, '设置成功') : z_ajax_info(0, '设置失败') ;
	}

	/**
	 * 修改签约信息
	 */
	public function editCommisionInfo($data)
	{
		$res = parent::doEdit($data);
		return $res ? z_ajax_info(1, '设置成功') : z_ajax_info(0, '设置失败') ;
	}

	/**
	 * 保存银行卡信息
	 */
	public function editBank($data)
	{
		$bank = new ZlibUserAuthorBankModel;
		$res = $bank->doEditBank($data);
		return $res ? z_ajax_info(1, '保存成功') : z_ajax_info(0, '保存失败') ;
	}
	
}