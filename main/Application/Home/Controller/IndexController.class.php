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
		$order = date('YmdHis', time()) . mt_rand(100000, 999999);
		
		/**
		 * @param int 用户id
		 * @param type 充值类型 ，其他待添加
		 * 'ALIPAY' => 0,	
		 * 'RDO' => 1,
		 * 'KEFU' => 10,
		 * 'SYSTEM' => 11,
		 * @param String memo 操作描述，增加将金币的时候，注意添加个失效时间
		 * @param String ip 操作的ip地址
		 */
		$counts = new \Zlib\Api\Account(15126427, 'SYSTEM', '', z_ip());
		// $counts->incre(500, $order);								// 增加逐浪币
		$counts->increBonus(500, $order, date('Y-m-t', time()));   // 增加逐浪奖金币

		z_log('充值成功', 'LOG_BUY');


		// 获取全部顶级分类
		$assign['book_top_class'] = Zapi\BookClass::getInstance()->getTopClass();

		$this->assign(array(
			'assign' => $assign,
		));

		$this->display();
	}
	
	
}
