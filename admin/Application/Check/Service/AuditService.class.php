<?php
/**
 * 审核表
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-04
 * @version 1.0
 */

namespace Check\Service;
use Zlib\Model\ZlibAuditModel;
use Zlib\Model\ZlibBookModel;

class AuditService extends ZlibAuditModel {

	protected $bookInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->bookInstance = new ZlibBookModel;
	}

	/**
	 * 设置封面作品状态
	 */
	public function setBookCoverStatus($data)
	{
		if ($data['status'] == 0)
			return z_ajax_info(-1, '请选择审核状态');

		// 设置审核表状态
		$this->setAuditStatus($data);

		// 修改作品的封面状态 为1
		$rs = $this->bookInstance->setBookCoverAllow($data['bk_id']);

		return $rs ? z_ajax_info(1, '审核成功') : z_ajax_info(0, '审核失败');
	}

	/**
	 * 设置作品全本状态
	 */
	public function setBookFullStatus($data)
	{
		if ($data['status'] == 0)
			return z_ajax_info(-1, '请选择审核状态');

		// 设置审核表状态
		$this->setAuditStatus($data);

		// 修改作品全本状态
		$rs = $this->bookInstance->setBookFullFlag($data['bk_id']);

		return $rs ? z_ajax_info(1, '审核成功') : z_ajax_info(0, '审核失败');
	}

	/**
	 * 设置作品封闭状态
	 */
	public function setBookCloseStatus($data)
	{
		if ($data['status'] == 0)
			return z_ajax_info(-1, '请选择审核状态');

		// 设置审核表状态
		$this->setAuditStatus($data);

		// 修改作品封笔
		$rs = $this->bookInstance->setBookClose($data['bk_id']);

		return $rs ? z_ajax_info(1, '审核成功') : z_ajax_info(0, '审核失败');
	}

	/**
	 * 修改用户昵称
	 */
	public function setNickname($data)
	{
		if ($data['status'] == 0)
			return z_ajax_info(-1, '请选择审核状态');

		$this->setAuditStatus($data);

		$user_instance = new \Zlib\Model\ZlibUserModel;
		$user_data['user_id'] = $data['user_id'];
		$user_data['user_nickname'] = $data['nickname'];
		$rs = $user_instance->setNickname($user_data);

		return $rs ? z_ajax_info(1, '审核成功') : z_ajax_info(0, '审核失败');
	}

	/**
	 * 设置audit表状态
	 */
	protected function setAuditStatus($data)
	{
		$audit_data['id'] = $data['id'];
		$audit_data['audit_time'] = z_now();
		$audit_data['admin_id'] = ZS('SESSION.admin', 'user_id');
		$audit_data['admin_name'] = ZS('SESSION.admin', 'user_nickname');
		$audit_data['confirm_id'] = ZS('SESSION.admin', 'user_id');
		$audit_data['confirm_name'] = ZS('SESSION.admin', 'user_nickname');
		$audit_data['confirm_time'] = z_now();
		$audit_data['status'] = $data['status'];
		$audit_data['audit_note'] = $data['audit_note'];

		// 修改审核记录
		parent::doEdit($audit_data);
	}

}