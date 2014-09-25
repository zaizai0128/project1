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

}