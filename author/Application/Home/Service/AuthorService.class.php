<?php
/**
 * 作者 service
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-24
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibUserModel;
use Zlib\Model\ZlibUserAuthorModel;

class AuthorService extends ZlibUserModel {
	
	/**
	 * 获取作者全部信息以及权限
	 * @param int user_id
	 */
	public function getAuthorInfoByUserId($user_id)
	{
		$user_info = $this->getUserFullInfoByUserId($user_id);

		// 获取该作者正在申请的书籍id
		$apply = D('BookApply', 'Service')->getApplyBookByUserId($user_id, 'bk_id');
		if (!empty($apply)) $apply = array_map(function($val){return $val['bk_id'];}, $apply);
		$user_info['apply'] = $apply;

		// 获取该作者拥有的书籍id
		$formal = D('Book', 'Service')->getBookByUserId($user_id, 'bk_id');
		if (!empty($formal)) $formal = array_map(function($val){return $val['bk_id'];}, $formal);
		$user_info['formal'] = $formal;

		return $user_info;
	}

	/**
	 * 修改作者资料
	 */
	public function doEditInfo($data)
	{
		// 判断 如果用户手机号已经验证，则无法进行修改手机操作
		if ($data['user_mobi_yz'] == 1 && isset($data['a_phone']))
			return z_info(-11, '手机号已验证，无法进行修改手机操作');

		// 如果邮箱已经验证，则无法进行修改邮箱操作
		// pass 暂时未有邮箱被验证字段

		// 用户表信息
		$final_user['user_id'] = $data['user_id'];
		$final_user['user_email'] = $data['a_email'];
		$final_user['user_mobile'] = $data['a_phone'];

		$result['user'] = parent::doEdit($final_user);

		// 作者表信息
		$result['author'] = D('UserAuthor', 'Service')->doAddInfo($data); 

		// 银行信息
		$result['bank'] = D('UserAuthorBank', 'Service')->doAddBank($data);

		return z_info(1, '修改成功');
	}

}