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
	static public function user()
	{
		// 用户必须登录
		if (!ZS('S.user', '?'))
			z_redirect('请先登录', ZU('login/index'));

		// 用户状态必须为 启用中
		if (ZS('S.user', 'user_state') != 0)
			z_redirect('账号被禁用', C('ZL_WWW')); 

		// 其他验证 待...

		return True;
	}

	/**
	 * 作者站验证机制
	 */
	static public function author()
	{
		// 用户必须登录
		if (!ZS('S.user', '?'))
			z_redirect('请先登录', ZU('login/index'));

		// 用户状态必须为 启用中
		if (ZS('S.user', 'user_state') != 0)
			z_redirect('账号被禁用', ZU('user/center/index')); 

		// 判断用户级别 02 03 作者
		if (!in_array(ZS('S.user', 'user_type'), array('02', '03', '04'))) {
			z_redirect('非作者', ZU('user/center/index'));
		}

		// 其他验证 待...

		return True;
	}

	/**
	 * 作者站作品验证机制
	 */
	static public function check($author_info, $book_id)
	{
		// 忽略掉的验证
		if (in_array(CONTROLLER_NAME, array('Book'))) {
			if (in_array(ACTION_NAME, array('index')))
				return True;
		}

		if (!in_array($book_id, $author_info['formal']))
			z_redirect('无权操作', ZU('index/index', 'ZL_AUTHOR_DOMAIN'));
	}

	/**
	 * 作者站的审核作品验证机制
	 */
	static public function apply($author_info, $book_id)
	{
		// 忽略掉的验证
		if (in_array(CONTROLLER_NAME, array('BookApply'))) {
			if (in_array(ACTION_NAME, array('index', 'add', 'doAdd')))
				return True;
		}

		if (!in_array($book_id, $author_info['apply']))
			z_redirect('无权操作', ZU('bookApply/index', 'ZL_AUTHOR_DOMAIN'));
	}

	
}