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
use Zlib\Model\ZlibAccountsModel;

class UserService extends ZlibUserModel {

	protected $accountInstance = Null;
	protected $userAuthorInstance = Null;

	public function init()
	{
		parent::init();
		$this->accountInstance = new ZlibAccountsModel;
		$this->userAuthorInstance = D('UserAuthor', 'Service');
	}

	/**
	 * 获取个人信息和账户余额
	 * @param int user_id
	 */
	public function getUserInfo($user_id)
	{
		$user_info = $this->getUserFullInfoByUserId($user_id);
		$user_info['user_like_tag'] = unserialize($user_info['like_tag']);
		$account = $this->accountInstance->getAccountByUserId($user_id);
		return array_merge($user_info, (array)$account);
	}

	/**
	 * 修改个人密码
	 */
	public function doEditPwd($data)
	{
		if (empty($data) || empty($data['pwd']) || empty($data['npwd']) || empty($data['repwd']))
			return z_info(-1, '密码不允许为空');
		if ($data['npwd'] != $data['repwd'])
			return z_info(-2, '二次密码不同');
		if (md5($data['pwd']) != $data['user_pwd'])
			return z_info(-3, '原密码不正确');

		$final_data['user_id'] = $data['user_id'];
		$final_data['user_pwd'] = md5($data['npwd']);

		$result = parent::doEdit($final_data);
		return z_info($result, '修改完成');
	}

	/**
	 * 修改个人信息
	 */
	public function doEditInfo($data)
	{
		// 验证
		$state = $this->_checkEditInfo($data);
		if ($state['code'] <= 0) return $state;

		$final_data = array();

		// 个人喜爱的小说类型
		if (!empty($data['like']) && !empty($data['like_name'])) {
			$final_data['user_like_tag'] = serialize(array_combine($data['like'], $data['like_name']));
		}

		// 修改主表信息
		$final_data['user_id'] = $data['user_id'];
		$final_data['user_sex'] = $data['sex'];
		$final_data['user_email'] = $data['email'];
		$final_data['user_qq'] = $data['qq'];
		$final_data['user_birthday'] = $data['birthday'];
		$final_data['user_mobile'] = $data['phone'];

		if (isset($data['nickname']) && !empty($data['nickname']))
			$final_data['user_nickname'] = $data['nickname'];

		// 修改主表信息
		$result = parent::doEdit($final_data);

		// 修改真实信息表信息
		$reuslt = $this->userAuthorInstance->doEdit($data);

		return z_info(1, '修改成功');
	}

	/**
	 * 验证修改个人信息
	 */
	private function _checkEditInfo($data)
	{	
		if (empty($data['user_id'])) return z_info(-1, '用户id不允许为空');
		if (isset($data['nickname']) && empty($data['nickname'])) return z_info(-11, '昵称不允许为空');

		$user = parent::getUserInfoByUserId($data['user_id'], 'user_id, user_nickname');
		if (empty($user)) return z_info(-2, '用户不存在');

		// 验证昵称是否允许被修改
		if (!empty($user['user_nickname']) && !empty($data['nickname'])) 
			return z_info(-3, '昵称不允许修改');

		// 验证昵称是否重复
		if (isset($data['nickname'])) {
			$user = parent::getUserInfoByNickName($data['nickname'], 'user_id');
			if (!empty($user)) return z_info(-4, '昵称不允许重复');
		}

		return z_info(1, '验证通过');
	}

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
}