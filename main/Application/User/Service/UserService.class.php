<?php
/**
 * 用户 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace User\Service;
use Zlib\Model\ZlibUserModel;

class UserService extends ZlibUserModel {

	/**
	 * 申请成为作者
	 */
	public function doAddApply($data)
	{
		// 一些验证 ...
		if (empty($data['user_id']))
			return z_info(-1, '用户id不允许为空');

		// 获取用户的申请信息
		$info = parent::getApplyInfoByUserId($data['user_id'], 'user_id');

		if (!empty($info))
			return z_info(-3, '您已经提交过申请，请等待我们的审核');
		
		// 验证成功 ...
		$final_data['aa_date'] = z_now();
		$final_data['user_id'] = $data['user_id'];
		$final_data['user_name'] = $data['user_name'];
		$final_data['user_true_name'] = $data['true_name'];
		$final_data['user_qq'] = $data['qq'];
		$final_data['user_mobile'] = $data['phone'];
		$final_data['aa_text'] = $data['ganyan'];
		$final_data['aa_read'] = 0;		// 是否已经读
		$final_data['aa_state'] = 0;	// 申请状态 0 未审核
		// 其他填充数据 ...

		$result = parent::doAddApply($final_data);

		if ($result > 0)
			return z_info(1, '添加成功');
		else
			return z_info(0, '添加失败');
	}
	
	/**
	 * 补充个人信息
	 */
	public function doEditExt($data)
	{
		// 一些验证 ...

		$final_data['user_email'] = $data['email'];
		$final_data['user_qq'] = $data['qq'];
		$final_data['user_mobile'] = $data['phone'];
		$final_data['user_id'] = $data['user_id'];

		$result = parent::doEdit($final_data);

		if ($result > 0) 
			return z_info(1, '修改成功');
		else
			return z_info(0, '修改失败');
	}

}