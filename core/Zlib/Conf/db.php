<?php
/**
 * 数据库配置信息
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */
return array(

	'DB_TYPE'               =>  'mysql',     	// 数据库类型
    'DB_HOST'               =>  '172.16.6.200', 	// 服务器数据库地址
    'DB_NAME'               =>  'zl',     		// 数据库名
    'DB_USER'               =>  'zhulang',     	// 用户名
    'DB_PWD'                =>  'zhulang',      // 密码
    'DB_PORT'               =>  '3307',        	// 端口
    'DB_PREFIX'             =>  '',    		// 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,      // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,       // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',     // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, 			// 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,      // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, 			// 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', 		// 指定从服务器序号
);