<?php
/**
 *  系统常量设置
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-04
 * @version 1.0
 */

return array(
	
	'ZL_WWW' => 'http://www.zhulang.ne',				// www域名
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
		'author' => 'user',		//作者的session存放key
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
		"user_level" => array(
			"1"=>array("0"=>1,"1"=>"15"),
			"2"=>array("0"=>16,"1"=>"30"),
			"3"=>array("0"=>81,"1"=>"60"),
			"4"=>array("0"=>256,"1"=>"120"),
			"5"=>array("0"=>625,"1"=>"125"),
			"6"=>array("0"=>1296,"1"=>"131"),
			"7"=>array("0"=>2401,"1"=>"138"),
			"8"=>array("0"=>4096,"1"=>"146"),
			"9"=>array("0"=>6561,"1"=>"155"),
			"10"=>array("0"=>10000,"1"=>"165"),
			"11"=>array("0"=>14641,"1"=>"176"),
			"12"=>array("0"=>20736,"1"=>"188"),
			"13"=>array("0"=>28561,"1"=>"201"),
			"14"=>array("0"=>38416,"1"=>"215"),
			"15"=>array("0"=>50625,"1"=>"230"),
			"16"=>array("0"=>65536,"1"=>"246"),
			"17"=>array("0"=>83521,"1"=>"263"),
			"18"=>array("0"=>104976,"1"=>"281"),
			"19"=>array("0"=>130321,"1"=>"300"),
			"20"=>array("0"=>160000,"1"=>"320"),
			"21"=>array("0"=>194481,"1"=>"341"),
			"22"=>array("0"=>234256,"1"=>"363"),
			"23"=>array("0"=>279841,"1"=>"386"),
			"24"=>array("0"=>331776,"1"=>"410"),
			"25"=>array("0"=>390625,"1"=>"435"),
			"26"=>array("0"=>456976,"1"=>"461"),
			"27"=>array("0"=>531441,"1"=>"488"),
			"28"=>array("0"=>614656,"1"=>"516"),
			"29"=>array("0"=>707281,"1"=>"545"),
			"30"=>array("0"=>810000,"1"=>"575"),
			"31"=>array("0"=>923521,"1"=>"606"),
			"32"=>array("0"=>1048576,"1"=>"638"),
			"33"=>array("0"=>1185921,"1"=>"671"),
			"34"=>array("0"=>1336336,"1"=>"705"),
			"35"=>array("0"=>1500625,"1"=>"740"),
			"36"=>array("0"=>1679616,"1"=>"776"),
			"37"=>array("0"=>1874161,"1"=>"813"),
			"38"=>array("0"=>2085136,"1"=>"851"),
			"39"=>array("0"=>2313441,"1"=>"890"),
			"40"=>array("0"=>2560000,"1"=>"930"),
			"41"=>array("0"=>2825761,"1"=>"971"),
			"42"=>array("0"=>3111696,"1"=>"999"),
			"43"=>array("0"=>3418801,"1"=>"999"),
			"44"=>array("0"=>3748096,"1"=>"999"),
			"45"=>array("0"=>4100625,"1"=>"999"),
			"46"=>array("0"=>4477456,"1"=>"999"),
			"47"=>array("0"=>4879681,"1"=>"999"),
			"48"=>array("0"=>5308416,"1"=>"999"),
			),
	),

	'BOOK' => array(
		'' => array(
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
		'max_book_apply_day' => 3,
		'chapter_list_size' => 10,

		// 正式作品章节的列表条数
		'auther_com_ban_words' => array('中国作者素材库',  // 推荐作品禁止包含
				'zzsck.com',
				'飞卢',
				'起点',
				'www.cmfu.com',
				'首发',
				'qq',
				'QQ',
				'逐浪币',
				'http',
				'第九中文网',
				'看书网',
				'网',
				'世纪文学',
				'炸弹',
				'炸药',
				'原子弹',
				'傲宇文学',
				'签约',
				),
		

	),

	// 章节相关
	'CHAPTER' => array(
		// 普通章节的操作地址
		'read' => 'http://172.16.6.200/books/read',	// [get]读/book_id/chapter_id
		'set' => 'http://172.16.6.200/books/set',	// [post]生成/book_id/chapter_id
		'rm' => 'http://172.16.6.200/books/rm',		// [get]删除/book_id/chapter_id

	),
	
	// 作品相关
	'BOOK' => array( 
		// 默认分卷
		'default_volume' => array(
			'-10' => '垃圾箱',
			'100' => '作品相关介绍',
			// '1000' => '正文',
		),

		// 分卷开始id
		'start_volume' => 1000,		// 对应的是上面的 正文
		
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
			'03' => '审核暂时通过',		// 兼容之前定义,
		),

		// 签约类型
		'commision' => array(
			'A' => array("name" => "A级签约","show" => 'A级签约' ),
			'B' => array("name" => "准A级签约","show" => "本站首发" ),
			'C' => 'C',
			'D' => 'D',
			'E' => 'E',
			'T' => 'T',			// 
			'X' => 'X',
			'Y' => 'Y',
			'Z' => 'Z',
		),

		// 签约类型
		'accredit' => array(
			'A' => '原创',
			'B' => '公众',
			'C' => '签约',
		),

		'commision_vip_chapter' => array('A', 'T', 'X', 'Y', 'Z'),		// 允许发VIP章节 

	) 
);
