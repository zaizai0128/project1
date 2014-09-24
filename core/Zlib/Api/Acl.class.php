<?php
/**
 * 前台acl权限验证机制
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Zlib\Api;

class Acl {

	/**
	 * 权限验证机制
	 */
	static public function run()
	{
		// 1 用户必须登录
		if (!ZS('S.user', '?'))
			z_redirect('请先登录', ZU('login/index'));

		// 其他验证 待...

	}

	/**
	 * 作者站验证机制
	 *
	 *
	 */
	static public function author()
	{
		// 用户必须登录
		if (!ZS('S.author', '?'))
			z_redirect('请先登录我', ZU('login/index'));
	}

}