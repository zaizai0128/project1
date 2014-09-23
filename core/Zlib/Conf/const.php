<?php
/**
 *  系统常量设置
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-04
 * @version 1.0
 */

return array(
	
	'ZL_DOMAIN' => 'http://zhulang.ne',					// 主站域名
	'ZL_BOOK_DOMAIN' => 'http://book.zhulang.ne',		// 书站域名
	'ZL_AUTHOR_DOMAIN' => 'http://author.zhulang.ne',	// 作者站域名
	'ZL_ADMIN_DOMAIN' => 'http://admin.zhulang.ne',		// 管理站域名
	'ZL_DOMAIN_DOT' => '.zhulang.ne',
	'ZL_NGINX_MODULE' => 'http://172.16.6.200',	// nginx module 地址 [用来对文件进行操作]

	// 系统相关
	'SYSTEM' => array(
		'encoded' => 'utf-8',	// 系统编码
	),
	// session相关
	'S' => array(
		'user' => 'user',		//前台用户的session存放key
		'author' => 'author',	//作者的session存放key
		'admin' => 'user',		//管理员的session存放key
	),

	// 金额相关
	'MONEY' => array(
		'fen' => 1, // 一分钱(人民币) = 多少逐浪币 
		'1000word' => 3, // 1000字多少逐浪币
	),

	// 用户相关
	'USER' => array(
		'type' => array(
			'00' => '普通会员',
			'01' => 'VIP会员',
			'02' => '普通作者',
			'03' => '驻站作者',
			'04' => '管理员',
		),

		// 注册类型
		'reg_type' => array(
			0 => '个性化注册',
			1 => '手机注册',
			2 => '邮箱注册',
		),
	),

	// 申请相关
	'APPLY' => array(

		// 申请作品允许上传的最多章节数
		'max_chapter_num' => 3,

		// 申请vip的作品字数条件
		'vip_book_size' => 30000,
		'vip_book_size_zh' => '3万',
		'vip_status' => array(
			'00' => '等待审核',
			'01' => '审核通过',
			'02' => '审核未通过',
		),
	),

	// 后台
	'ADMIN' => array(

		// 后台待审核作品的列表
		'apply_list_size' => 10,

	),

	// 作者
	'AUTHOR' => array(

		// 正式作品章节的列表条数
		'chapter_list_size' => 10,

	),

	// 章节相关
	'CH' => array(
		// 普通章节的操作地址
		'read' => 'http://172.16.6.200/book/read',	// [get]读/book_id/chapter_id
		'set' => 'http://172.16.6.200/book/set',	// [post]生成/book_id/chapter_id
		'rm' => 'http://172.16.6.200/book/rm',		// [get]删除/book_id/chapter_id

	),
	
	// 作品相关
	'BK' => array(

		// 默认分卷
		'default_volume' => array(
			'-10' => '垃圾箱',
			'100' => '作品相关介绍',
		),

		// 分卷开始id
		'start_volume' => 1000,
		
		// 授权等级 -- 新建作品时候的授权等级
		'auth_level' => array(
			1 => '首发作品',
			2 => '驻站作品',
			3 => '公众作品',
		),

		// 作品连载属性
		'full_flag' => array(
			0 => '连载',
			1 => '全本',
			2 => '封笔',
		),

		// 审核状态
		'check_status' => array(
			'00' => '未审核',
			'01' => '审核通过',
			'02' => '审核未通过',
		),

		// 签约类型
		'commision' => array(
			'A' => 'A',
			'B' => 'B',
			'C' => 'C',
			'D' => 'D',
			'E' => 'E',
			'T' => 'T',
			'X' => 'X',
			'Y' => 'Y',
			'Z' => 'Z',
		),

		// 签约类型
		'commision' => array(
			'A' => 'A',
			'B' => 'B',
			'C' => 'C',
			'D' => 'D',
			'E' => 'E',
			'T' => 'T',
			'X' => 'X',
			'Y' => 'Y',
			'Z' => 'Z',
		),
	)
);