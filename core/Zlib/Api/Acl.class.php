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
	 * 应用操作的权限验证
	 */
	static public function app($user_info)
	{
		$user_info = array_filter($user_info);
		if (empty($user_info))
			z_redirect('请先登录', ZU('login/index', 'ZL_DOMAIN', array('setback'=>z_referer(1))), 2, -1);
	}

	/**
	 * 后台管理员验证操作权限
	 */
	static public function admin($admin_info)
	{
		if (empty($admin_info))
			z_redirect('未登录', ZU('login/index', 'ZL_ADMIN_DOMAIN'));

		if ($admin_info['user_name'] == 'timerlau')
			return True;

		// 其他验证 ...
		
		
		return True;
	}

	/**
	 * 购买验证机制
	 *
	 * @return 消费的类型
	 */
	static public function cost($user_info, $book_info, $chapter_info)
	{
		if (empty($user_info))
			z_redirect('未登录', ZU('login/index', 'ZL_DOMAIN', array('setback'=>z_referer())));

		if (empty($book_info))
			z_redirect('作品不存在', '', 2, -1);

		$book_allow = array('00', '04');
		if (!in_array($book_info['bk_status'], $book_allow))
			return z_redirect('该作品已被关闭', '', 2, -1);

		if (empty($chapter_info))
			z_redirect('章节不存在', '', 2, -1);

		if ($chapter_info['ch_status'] != 0)
			z_redirect('章节关闭，禁止购买', '', 2, -1);

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
	 * 购买卷（批量购买）
	 * @param Array 用户信息
	 * @param Array 卷信息
	 * @param String 购买的章节id字符串
	 */
	static public function costVolume($user_info, $book_info, $volume_info, $buy_ids)
	{
		if (empty($user_info))
			return z_info(-1, '未登录');
		if (empty($book_info))
			return z_info(-2, '作品不存在');

		$book_allow = array('00', '04');
		if (!in_array($book_info['bk_status'], $book_allow))
			return z_info(-21, '该作品已被关闭');
		if (empty($volume_info))
			return z_info(-3, '卷信息不存在');
		if (empty($buy_ids))
			return z_info(-4, '购买章节不存在');

		$now = date('Y-m-d', time());
		$ids = explode(',', $buy_ids);
		$total_price = 0;

		foreach ($ids as $chapter_id) {

			// 如果该章节不存在，则返回错误
			if (!isset($volume_info['volume_chapter'][$chapter_id]) || empty($volume_info['volume_chapter'][$chapter_id]))
				return z_info(-4, '章节不存在');

			$total_price += (int)$volume_info['volume_chapter'][$chapter_id]['chapter_price'];
		}

		$cost_type = Null;

		// 银币在时限之内，并且大于章节的钱，则消耗银币
		if ($user_info['bonus'] >= $total_price 
			&& $now <= $user_info['bonus_expire']) {

			$cost_type = 2;	// 设置消耗类型为银币
			
		// 消耗金币
		} else {
			if ($user_info['amount'] >= $total_price) {
				$cost_type = 1;
			} else {
				return z_info(-5, '对不起，您的余额不足，请先充值');
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
			z_redirect('章节不存在', '', 2, -1);

		if ($chapter_info['ch_status'] != 0)
			z_redirect('该章节无法购买', '', 2, -1);

		if ($chapter_info['ch_vip'] != 1)
			z_redirect('该章节不是vip，无需购买', ZU('read/index', 'ZL_BOOK_DOMAIN', 
						array('book_id'=>$chapter_info['bk_id'], 'ch_id'=>$chapter_info['ch_id'])));

		return True;
	}

	/**
	 * 卷购买验证机制
	 */
	static public function buyVolume($volume_info)
	{	
		if (empty($volume_info))
			z_redirect('卷不存在');

		return true;
	}

	/**
	 * 权限验证机制
	 */
	static public function user($user_info)
	{
		$user_info = array_filter($user_info);
		
		// 用户必须登录
		if (empty($user_info))
			z_redirect('请先登录', ZU('login/index', 'ZL_DOMAIN', array('setback'=>z_referer())));

		// 用户状态必须为 启用中
		if ($user_info['user_state'] != 0)
			z_redirect('账号禁止使用', C('ZL_WWW')); 

		// 其他验证 待...

		return True;
	}

	/**
	 * 作者站验证机制
	 */
	static public function author($author_info)
	{
		// 用户必须登录
		if (empty($author_info))
			z_redirect('请先登录', ZU('login/index', 'ZL_DOMAIN', array('setback'=>ZU('index/index', 'ZL_AUTHOR_DOMAIN'))));

		// 用户状态必须为 启用中
		if ($author_info['user_state'] != 0)
			z_redirect('账号被禁用', ZU('user/center/index')); 
		
		// 判断用户级别 02 03 作者
		if (!in_array($author_info['user_type'], array('02', '03', '04'))) {
			z_redirect('非作者', ZU('user/center/area'));
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

		// 如果是后台管理员，则忽略
		if ($author_info['user_type'] == '04')
			return True;

		if (!in_array($book_id, $author_info['formal']))
			z_redirect('无权操作', ZU('index/index', 'ZL_AUTHOR_DOMAIN'), 2, -1);

		// 判断作品状态，是否可以修改
		$book = new \Zlib\Model\ZlibBookModel;
		$status = $book->getBookByBookId($book_id, 'bk_status, bk_fullflag');

		$allow = array('00', '03');
		if (!in_array($status['bk_status'], $allow))
			z_redirect('该作品状态禁止作者编辑，如有问题，请联系客服人员', '', 2, -1);

		// 非连载作品，无法操作
		if ($status['bk_fullflag'] != 0)
			z_redirect('非连载的作品无法进行编辑', '', 2, -1);

		// 其他验证 待add...

		return True;
	}

	/**
	 * 作者站 章节管理的验证机制
	 * 应该验证章节信息，而不是作品信息了。
	 */
	static public function checkChapter($book_info)
	{
		
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

		// 通过book_id 获取该书的状态，如果已审核过了，则跳到正式作品管理界面
		$book = new \Zlib\Model\ZlibBookApplyModel;
		$apply_info = $book->getApplyBookByBookId($book_id, 'bk_apply_status');
		if (empty($apply_info))
			z_redirect('作品不存在');
		elseif ($apply_info['bk_apply_status'] == '01')
			z_redirect('该作品已通过审核', ZU('book/index', 'ZL_AUTHOR_DOMAIN'));
		elseif (in_array($apply_info['bk_apply_status'], array('02', '03')))
			z_redirect('该作品审核未通过', ZU('bookApply/index', 'ZL_AUTHOR_DOMAIN'));

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

		// 白名单
		$allow = array('00', '04');

		// 如果不在白名单，则提示作品不存在
		if (!in_array($book_info['bk_status'], $allow)) {
			z_redirect('作品不存在', C('ZL_WWW'));
		}

		// 其他验证 待...

		return True;
	}

	/**
	 * 书站阅读章节验证权限
	 * @param array chapter_info
	 */
	static public function chapter($chapter_info)
	{	
		$is_deny = false;
		$now = z_now();

		if (empty($chapter_info) || $chapter_info['ch_status'] != 0) {
			$is_deny = true;
		} elseif ($chapter_info['ch_effect_time'] != '0000-00-00 00:00:00' && $chapter_info['ch_effect_time'] > $now) {
			$is_deny = true;
		} else {
			$is_deny = false;
		}

		if ($is_deny)
			z_redirect('该章节不存在', ZU('index/index', 'ZL_BOOK_DOMAIN', array('book_id'=>$chapter_info['bk_id'])), 2, -1);	

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
		$user_id = ZS('SESSION.user', 'user_id');

		// 验证用户是否已购买该章节
		$vip = new \Zlib\Api\UserVipBuy($user_id, $chapter_info['bk_id']);
		$buy = $vip->isBuyByOrder($chapter_info['ch_order']);

		if (!$buy) {
			z_redirect('请先购买该章节', ZU('buy/index/chapter', 'ZL_DOMAIN', 
			array('book_id'=>$chapter_info['bk_id'], 'ch_id'=>$chapter_info['ch_id'])));
		}

		return True;
	}
}