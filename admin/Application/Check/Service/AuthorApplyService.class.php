<?php
/**
 * 作者申请 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-24
 * @version 1.0
 */
namespace Check\Service;
use Zlib\Model\ZlibUserModel;
use Zlib\Model\ZlibUserAuthorModel;

class AuthorApplyService extends ZlibUserModel { 

	protected $userAuthorInstance = Null;
	protected $info = Null;

	public function init()
	{
		parent::init();
		$this->userAuthorInstance = new ZlibUserAuthorModel;
	}

	/**
	 * 设置审核信息
	 */
	public function setInfo($info)
	{
		$this->info = $info;
	}

	/**
	 * 获取审核信息
	 */
	public function getInfo()
	{
		return $this->info;
	}

	/**
	 * 执行允许审核动作
	 *
	 */
	public function doCheckApply($data)
	{
		// 获取审核表信息
		$apply_data = parent::getApplyInfoById($data['id']);

		if (empty($apply_data)) return z_ajax_info(-1, '信息不存在');
		if ($apply_data['aa_state'] != '0') return z_ajax_info(-2, '该用户已完成审核');

		// 设置审核信息
		$this->setInfo($apply_data);

		// 判断要执行的动作
		if ($data['aa_state'] == '0') 
			return z_ajax_info(-3, '请选择审核的状态');

		// 不通过
		elseif ($data['aa_state'] == '2')
			return $this->_doDenyApply($data);
		
		// 审核通过...

		// 修改审核表状态
		$check_data['aa_state'] = $data['aa_state'];
		$check_data['aa_auditing_name'] = $data['user_name'];
		$check_data['aa_auditing_date'] = z_now();
		$check_data['aa_memo'] = $data['aa_memo'];
		$check_data['user_id'] = $apply_data['user_id'];
		$result = parent::doEditApply($check_data);

		// 修改用户状态为作者
		$user_data['user_type'] = '02'; // 02 || 03
		$user_data['user_id'] = $apply_data['user_id'];
		$user_data['user_mobile'] = $apply_data['user_mobile'];
		$user_data['user_telephone'] = $apply_data['user_tel'];
		$user_data['user_qq'] = $apply_data['user_qq'];
		$result = parent::doEdit($user_data);

		// 填充作者数据
		$author_data['user_id'] = $apply_data['user_id'];
		$author_data['author_name'] = $apply_data['author_name'];
		$author_data['user_true_name'] = $apply_data['user_true_name'];
		$author_data['create_time'] = z_now();

		// 分配一个随机的责任编辑？

		$result = $this->userAuthorInstance->doAdd($author_data);

		if ($result)
			return z_ajax_info(1, '审核完成');
		else
			return z_ajax_info(0, '审核失败，请重新尝试');
	}

	/**
	 * 设置审核未通过状态
	 */
	private function _doDenyApply($data)
	{
		$info = $this->getInfo();
		
		// 给作者发送站内信，说明审核未通过。
		// Zlib/Api/Tool::sendInfo();

		// 修改审核表状态
		$check_data['aa_state'] = $data['aa_state'];
		$check_data['aa_auditing_name'] = $data['user_name'];
		$check_data['aa_auditing_date'] = z_now();
		$check_data['aa_memo'] = $data['aa_memo'];
		$check_data['user_id'] = $info['user_id'];
		$result = parent::doEditApply($check_data);

		if ($result)
			return z_ajax_info(1, '审核完成');
		else
			return z_ajax_info(0, '审核失败，请重新尝试');
	}

	/**
	 * 获取审核信息
	 */
	public function getApplyInfo($id)
	{
		$apply_info = parent::getApplyInfoById($id, '*');
		$user_info = parent::getUserFullInfoByUserId($apply_info['user_id']);
		return array_merge((array)$apply_info, (array)$user_info);
	}
}
