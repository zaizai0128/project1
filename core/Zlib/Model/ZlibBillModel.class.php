<?php
/**
 * 消费流水 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-25
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBillModel extends BaseModel {

	protected $billInstance = Null;	//数据库对象
	protected $billPrefix = 'zl_bill_'; // 表前缀
	protected $tableName = Null;	// 表名
	protected $dataWhere = Null;	// 日期条件

	/**
	 * 初始化对象
	 */
	protected function init()
	{
		parent::init();
		// 设置数据库名称，默认当前年月
		$this->setTableName();
		// 设置日期条件
		$this->setDataWhere();
		// 如果不存在，则创建数据库
		// $this->createTable();
		// 获取数据库操作对象
		$this->billInstance = $this->getInstance();
	}

	/**
	 * 获取数据库操作对象
	 */
	public function getInstance()
	{
		return M($this->tableName);
	}

	/**
	 * 设置数据库名称
	 */
	public function setTableName($ym = Null)
	{
		// $ym = empty($ym) ? date('Ym', time()) : $ym;
		// $this->tableName = $this->billPrefix . $ym;
		$this->tableName = 'zl_bill';
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	/**
	 * 设置日期条件
	 * @param int 时间戳格式
	 */
	public function setDataWhere($time = Null)
	{
		// 获取时间戳
		$time = empty($time) || !is_int($time) ? time() : $time ;

		// 获取日份
		$fromDay = 1;
		$toDay = date('t', $time);

		$fromTime = date('Y-m', $time) . '-' . $fromDay . ' 00:00:00';
		$toTime = date('Y-m', $time) . '-' . $toDay . ' 23:59:59';

		$where = ' and time >= "'.$fromTime.'" and time <= "'.$toTime.'"';
		$where .= ' and status = 1';	// 添加消费账单的状态
		$this->dataWhere = $where;
	}

	/**
	 * 获取日期条件
	 */
	public function getDataWhere()
	{
		return $this->dataWhere; 
	}

	/**
	 * 添加流水账单
	 */
	public function doAdd($data)
	{
		return $this->billInstance->data($data)->add();
	}

	/**
	 * 获取用户的订单详情总数
	 */
	public function getBillDetailTotal($user_id, $order_id)
	{	
		$condition = 'order_id = '.$order_id.' and user_id = '.$user_id.' and status = 1';
		$result = $this->billInstance->field('chapter')->where($condition)->select();

		// 获取订单详情的数组
		$order = array();
		foreach($result as $val) {
			$tmp = json_decode($val['chapter'], true);
			$order = array_merge($order, (array)$tmp);
		}

		return count($order);
	}

	/**
	 * 获取用户的订单详情
	 *
	 * @param int user_id
	 * @param int order_id
	 * @param array page
	 */
	public function getBillDetail($user_id, $order_id, $page = Null)
	{
		$condition = 'order_id = '.$order_id.' and user_id = '.$user_id.' and status = 1';
		$result = $this->billInstance->field('chapter')->where($condition)->select();

		// 获取订单详情的数组
		$order = array();
		foreach($result as $val) {
			$tmp = json_decode($val['chapter'], true);
			$order = array_merge($order, (array)$tmp);
		}

		if (!empty($page) && is_array($page)) {
			$order = array_slice($order, $page['firstRow'], $page['listRows']);
		}

		return $order;
	}

	/**
	 * 获取某用户的流水帐单
	 *
	 * @param int user_id
	 * @param string field
	 * @param array page
	 */
	/* by libin
	public function getBillList($user_id, $field = '*', $page = Null)
	{
		$condition = 'user_id = '.$user_id;
		$condition .= $this->dataWhere;

		if (!empty($page) && is_array($page)) {
			return $this->billInstance->field($field)->where($condition)
					->limit($page['firstRow'], $page['listRows'])->order('time desc')->select();
		}
		return $this->billInstance->field($field)->where($condition)->order('time desc')->select();
	}
	*/

	// public function getBillList($user_id, $field = '*', $page = Null)
	// {
	// 	$condition = 'user_id = '.$user_id;
	// 	$condition .= $this->dataWhere;

	// 	// 获取全部数据
	// 	$row  = $this->billInstance->field($field)->where($condition)->order('time desc')->select();
	// 	$count = count($row); 	
	// 	$result = array();
	// 	for ($i = 0; $i < $count; $i++) {		
	// 		$temp = array();	
	// 		$temp['time'] = $row[$i]['time'];
	// 		$temp['buy_type'] = $row[$i]['buy_type'];
	// 		$temp['pay_type'] = $row[$i]['pay_type'];
	// 		$temp['pay_money'] = $row[$i]['pay_money'];
	// 		$temp['bk_id'] = $row[$i]['bk_id'];
	// 		$temp['bk_name'] = $row[$i]['bk_name'];
	// 		if ($row[$i]['buy_type'] == 2 ) {	
	// 			$chapter = json_decode($row[$i]['chapter'], True);
	// 			$ch_count = count($chapter);
	// 			for ($j = 0; $j < $ch_count; $j++) {
	// 				$temp['buy_item'] = $chapter[$i]['name'];
	// 				$temp['pay_money'] = $chapter[$i]['price'];
	// 				array_push($result, $temp);
	// 			} 	
	// 		} else if ($row[$i]['buy_type'] == 1) {	
	// 			$chapter = json_decode($row[$i]['chapter'], True);
	// 			$ch_count = count($chapter);
	// 			$temp['buy_item'] = $chapter[0]['name'];
	// 			$temp['pay_money'] = $chapter[0]['price'];
	// 			array_push($result, $temp);
	// 		} else if ($row[$i]['buy_type'] == 'A') {	
	// 				$temp['buy_item'] = '打赏';
	// 			array_push($result, $temp);
	// 		}
	// 	}

	// 	// 如果含有分页
	// 	if (!empty($page) && is_array($page)) {
	// 		$result = array_slice($result, $page['firstRow'], $page['listRows']);
	// 	}
	// 	return $result;
	// }

	/**
	 * 获取消费订单列表
	 */
	public function getBillList($user_id, $page = Null)
	{
		$condition = 'user_id = '.$user_id;
		$result  = $this->billInstance->field('bk_id,bk_name,order_id,pay_type,buy_type,SUM(buy_num) AS buy_num, SUM(pay_money) AS pay_money, time')
					->where($condition)->order('time desc')
					->group('order_id')->select();

		if (!empty($page) && is_array($page)) {
			$result = array_slice($result, $page['firstRow'], $page['listRows']);
		}
		
		return $result;
	}

	/**
	 * 获取订单总数
	 */
	public function getBillTotal($user_id)
	{
		$condition = 'user_id = '.$user_id;
		$row  = $this->billInstance->field('order_id')
					->where($condition)->order('time desc')
					->group('order_id')->select();
		return count($row);
	}	

	/**
	 * 获取用户的流水账单总数
	 */
	/* 为了配合上面的查询方式，获取全部的数组个数
	public function getBillTotal($user_id)
	{
		$condition = 'user_id = '.$user_id;
		$condition .= $this->dataWhere;
		return $this->billInstance->where($condition)->count();
	}
	*/

	/**
	 * 获取某用户消费总额（当前月）
	 * @param int user_id
	 */
	public function getCostSum($user_id)
	{
		$condition = 'user_id = '.$user_id;
		return $this->billInstance->where($condition)->sum('pay_money');
	}

	/**
	 * 验证数据库是否存在
	 */
	public function createTable()
	{
		$buildSql =<<<SQL
CREATE TABLE IF NOT EXISTS `$this->tableName` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) unsigned NOT NULL COMMENT '购买人id',
  `user_name` varchar(50) NOT NULL COMMENT '购买人用户名',
  `user_type` char(2) NOT NULL DEFAULT '00' COMMENT '购买人用户类型',
  `bk_id` int(10) unsigned NOT NULL COMMENT '作品id',
  `bk_name` varchar(50) NOT NULL COMMENT '作品名称',
  `chapter` text NOT NULL COMMENT '购买的章节',
  `author_id` int(10) unsigned NOT NULL COMMENT '作者id',
  `author_name` varchar(20) NOT NULL COMMENT '作者笔名',
  `pay_money` float NOT NULL COMMENT '支付的金额',
  `pay_type` char(1) NOT NULL DEFAULT '1' COMMENT '支付方式 1逐浪金币 2逐浪银币',
  `buy_num` mediumint(8) unsigned NOT NULL COMMENT '购买章节数量',
  `buy_type` char(1) NOT NULL DEFAULT '1' COMMENT '购买类型 1单章节 2卷 A打赏',
  `discount_type` char(5) NOT NULL COMMENT '折扣类型 根据配置文件获取',
  `time` datetime NOT NULL COMMENT '购买时间',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '预留状态',
  `detail` text NOT NULL COMMENT '操作明细',
  `from_ch_order` bigint(11) unsigned DEFAULT '0' COMMENT '起始章节',
  `to_ch_order` bigint(11) unsigned DEFAULT '0' COMMENT '结束章节',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk` (`user_id`,`bk_id`,`from_ch_order`),
  KEY `index_time` (`time`),
  KEY `user_id` (`user_id`),
  KEY `bk_id` (`bk_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
SQL;
		$this->execute($buildSql);
	}
}
