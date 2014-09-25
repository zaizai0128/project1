<?php
/**
 * index
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class IndexController extends HomeController {

	/**
	 * 网站首页
	 */
	public function index()
	{
		// 获取全部顶级分类
		$assign['book_top_class'] = Zapi\BookClass::getInstance()->getTopClass();

		$this->assign(array(
			'assign' => $assign,
		));
	/*
		$my =  new Zapi\UserVipBuy(12533415, 270971);
		echo "buy:92".$this->iv($my->isBuyByOrder(92));
		echo "buy:94".$this->iv($my->isBuyByOrder(94));
		echo "buy:97".$this->iv($my->isBuyByOrder(97));
	*/
		$this->display();
	}
	
	function iv($b) {
		return $b ? '1' : '0';
	}
	
}
