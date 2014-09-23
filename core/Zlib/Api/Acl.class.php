<?php
/**
 * acl权限验证机制
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
			$this->error('请先登录', ZU('login/index'));

		// 其他验证 待...

	}


}