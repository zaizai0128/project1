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
	 * 后台管理员验证操作权限
	 *
	 * @param array admin_info
	 */
	static public function admin($admin_info)
	{
		if (empty($admin_info))
			z_redirect('未登录');

		if ($admin_info['user_type'] != '04')
			z_redirect('不是管理员');

		return True;
	}

	/**
	 * 购买验证机制
	 *
	 * @return 消费的类型
	 */
	static public function cost($user_info, $chapter_info)
	{
		if (empty($user_info))
			z_redirect('未登录', ZU('login/index', 'ZL_DOMAIN', array('setback'=>z_referer())));

		$now = date('Y-m-d', time());

		// 已经拥有该章节权限，无需再次购买
		$buy_instance = new \Zlib\Api\UserVipBuy($user_info['user_id'], $chapter_info['bk_id']);
		$is_buy = $buy_instance->isBuyByOrder($chapter_info['ch_order']);

		if ($is_buy) {
			z_redirect('您已购买此章节，无需购买', ZU('read/index', 'ZL_BOOK_DOMAIN',
					array('book_id'=>$chapter_info['bk_id'], 'ch_id'=>$chapter_info['ch_id'])));
		}

		// 银币在时限之内，并且大于章节的钱，则消耗银币
		if ($user_info['bonus'] >= $chapter_info['ch_price'] 
			&& $now <= $user_info['bonus_expire']) {

			$cost_type = 2;	// 设置消耗类型为银币
			
		// 消耗金币
		} else {
			if ($user_info['amount'] >= $chapter_info['ch_price']) {
				$cost_type = 1;
			} else {
				z_redirect('对不起，您的余额不足，请先充值');
			}
		}

		return $cost_type;
	}

	/**
	 * 购买页面验证机制
	 */
	static public function buy($chapter_info)
	{
		if (empty($chapter_info))
			z_redirect('章节不存在');

		if ($chapter_info['ch_lock'] != 0)
			z_redirect('该章节已经被锁，无法购买');

		if ($chapter_info['ch_status'] != 0)
			z_redirect('该章节无法购买');

		if ($chapter_info['ch_vip'] != 1)
			z_redirect('该章节不是vip，无需购买', ZU('read/index', 'ZL_BOOK_DOMAIN', 
						array('book_id'=>$chapter_info['bk_id'], 'ch_id'=>$chapter_info['ch_id'])));

		return True;
	}

	/**
	 * 权限验证机制
	 */
	static public function user()
	{
		// 用户必须登录
		if (!ZS('SESSION.user', '?'))
			z_redirect('请先登录', ZU('login/index', 'ZL_DOMAIN', array('setback'=>z_referer())));

		// 用户状态必须为 启用中
		if (ZS('SESSION.user', 'user_state') != 0)
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
		if (!ZS('SESSION.user', '?'))
			z_redirect('请先登录', ZU('login/index', 'ZL_DOMAIN', array('setback'=>ZU('index/index', 'ZL_AUTHOR_DOMAIN'))));

		// 用户状态必须为 启用中
		if (ZS('SESSION.user', 'user_state') != 0)
			z_redirect('账号被禁用', ZU('user/center/index')); 

		// 判断用户级别 02 03 作者
		if (!in_array(ZS('SESSION.user', 'user_type'), array('02', '03', '04'))) {
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

		// 其他验证 待...

		return True;
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

		// 其他验证 待...

		return True;
	}

	/**
	 * 书站阅读权限验证
	 * @param array book_info
	 */
	static public function book($book_info)
	{
		if (empty($book_info))
			z_redirect('作品不存在', C('ZL_WWW'));

		if ($book_info['bk_status'] == '01')
			z_redirect('该作品已被关闭', C('ZL_www'));

		if ($book_info['bk_status'] == '02' || $book_info['bk_status'] == '03')
			z_redirect('该作品未经管理员审核', C('ZL_www'));

		// 其他验证 待...

		return True;
	}

	/**
	 * 书站阅读章节验证权限
	 * @param array chapter_info
	 */
	static public function chapter($chapter_info)
	{	
		if (empty($chapter_info))
			z_redirect('章节不存在');

		if ($chapter_info['ch_lock'] == 1)
			z_redirect('该章节处于修改中');

		if ($chapter_info['ch_status'] != 0)
			z_redirect('该章节非对外开放');

		// 如果是vip章节，则继续验证
		if ($chapter_info['ch_vip'] == 1)
			self::chapterVip($chapter_info);

		return True;
	}

	/**
	 * 书站vip阅读章节验证权限
	 *
	 * @param array $chapter_info
	 */
	static public function chapterVip($chapter_info)
	{
		// 验证用户是否已购买该章节
		$vip = new \Zlib\Api\UserVipBuy(ZS('SESSION.user', 'user_id'), $chapter_info['bk_id']);
		$buy = $vip->isBuyByOrder($chapter_info['ch_order']);

		if (!$buy) {
			z_redirect('请先购买该章节', ZU('buy/index/chapter', 'ZL_DOMAIN', 
			array('book_id'=>$chapter_info['bk_id'], 'ch_id'=>$chapter_info['ch_id'])));
		}

		return True;
	}
}