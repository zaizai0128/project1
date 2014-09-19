<?php
/**
 * 购买页面
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Buy\Controller;
use Zlib\Api as Zapi;

class IndexController extends BuyController {

	protected $volume_list = array();

	/**
	 * 购买单个章节的界面
	 */
	public function chapter()
	{	
		$assign = array();
		
		// 获取卷章节
		$volume_list = $this->book_obj->getCatalog();

		// 如果用户存在，则获取该用户的account
		if (ZS('S.user', '?')) {
			$user_api = new Zapi\User(ZS('S.user', 'user_id'));
			$account = $user_api->getAccountInfo();
		}
		
		$this->assign(array(
			'assign' => $assign,
			'chapter_info' => $this->chapter_info,
			'book_info' => $this->book_info,
			'volume_list' => $volume_list,
			'account_info' => $account,
		));
		$this->display();
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