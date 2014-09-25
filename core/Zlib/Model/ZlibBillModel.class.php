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

	/**
	 * 初始化对象
	 */
	protected function init()
	{
		parent::init();
		// 设置数据库名称，默认当前年月
		$this->setTableName();
		// 如果不存在，则创建数据库
		$this->createTable();
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
		$ym = empty($ym) ? date('Ym', time()) : $ym;
		$this->tableName = $this->billPrefix . $ym;;
	}

	/**
	 * 添加流水账单
	 */
	public function doAdd($data)
	{
		return $this->billInstance->data($data)->add();
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
  `chapter` text NOT NULL COMMENT '购买的章节',
  `author_id` int(10) unsigned NOT NULL COMMENT '作者id',
  `author_name` varchar(20) NOT NULL COMMENT '作者笔名',
  `pay_money` float NOT NULL COMMENT '支付的金额',
  `pay_type` char(1) NOT NULL DEFAULT '1' COMMENT '支付方式 1逐浪金币 2逐浪银币',
  `buy_num` mediumint(8) unsigned NOT NULL COMMENT '购买章节数量',
  `buy_type` char(1) NOT NULL DEFAULT '1' COMMENT '购买类型 1单章节 2卷',
  `discount_type` char(5) NOT NULL COMMENT '折扣类型 根据配置文件获取',
  `time` datetime NOT NULL COMMENT '购买时间',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '预留状态',
  `detail` text NOT NULL COMMENT '操作明细',
  PRIMARY KEY (`id`),
  KEY `index_time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
SQL;
		$this->execute($buildSql);
	}
}