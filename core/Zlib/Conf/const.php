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

	// session相关
	'S' => array(
		'user' => 'user',		//前台用户的session存放key
		'author' => 'author',	//作者的session存放key
		'admin' => 'admin',		//管理员的session存放key
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
	),

	// 申请相关
	'APPLY' => array(

		// 申请作品允许上传的最多章节数
		'max_chapter_num' => 3,


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