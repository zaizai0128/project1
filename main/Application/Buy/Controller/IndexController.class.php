<?php
/**
 * 购买页面
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Buy\Controller;

class IndexController extends BuyController {

	/**
	 * 购买单个章节的界面
	 */
	public function chapter()
	{
		


		dump($this->chapter_info);

		$this->display();
	}

	/**
	 * 执行购买流程
	 */
	public function doCost()
	{
		// 开启事务

			// 用户zl_accounts 减 对应的价钱

			// 作者zl_accounts 加 对应的价钱	

			// 记录到流水

		// commit执行

		// 将 该章节的 ch_order 存到 zl_user_vipby表中

		// 购买结束？
	}

	/**
	 * 卷购买
	 */
	public function volume()
	{

		echo 'buy volume chapter';

		$this->display();
	}

}