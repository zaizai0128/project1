<?php
/**
 *  系统常量设置
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-04
 * @version 1.0
 */

// 基础常量定义
define('ZL_IMAGE_PATH', '/data/wwwroot/zhulang.ne/images'); // 原图片样式物理地址
define('ZL_NGINX_MODULE', 'http://172.16.6.200');			// nginx module 地址 [用来对文件进行操作]	

return array(
	
	'ZL_WWW' => 'http://www.zhulang.ne',				// www域名
	'ZL_DOMAIN' => 'http://zhulang.ne',					// 主站域名
	'ZL_BOOK_DOMAIN' => 'http://book.zhulang.ne',		// 书站域名
	'ZL_AUTHOR_DOMAIN' => 'http://author.zhulang.ne',	// 作者站域名
	'ZL_ADMIN_DOMAIN' => 'http://admin.zhulang.ne',		// 管理站域名
	'ZL_STYLE_DOMAIN' => 'http://stc.zhulang.ne',		// 静态样式文件域名
	'ZL_IMAGE_DOMAIN' => 'http://images.zhulang.com',	// 原图片样式文件域名
	'ZL_NV_IMAGE_DOMAIN' => 'http://images.xxs8.com',		// 原女频图片样式文件域名
	'ZL_DOMAIN_DOT' => '.zhulang.ne',
	
	'ZL_BOOK_COVER_PATH' => ZL_IMAGE_PATH.'/book_cover/image',// 作品封面目录物理地址


	// 系统相关
	'SYSTEM' => array(
		'encoded' => 'utf-8',	// 系统编码
	),

	// 日志相关
	'LOG' => array(
		'type' => array(
			0 => 'default',			// 默认日志，暂时未知
			1 => 'buy',				// 购买日志
			2 => 'cost',			// 消费日志
			3 => 'app',				// 应用日志，鲜花，打赏等
			4 => 'user',			// 用户日志，登录，修改密码等
		),	// 日志类型
	),

	// session相关
	'SESSION' => array(
		'user' => 'user',		//前台用户的session存放key
		'author' => 'user',		//作者的session存放key
		'admin' => 'admin',		//管理员的session存放key
	),

	// 金额相关
	'MONEY' => array(
		'fen' => 1, // 一分钱(人民币) = 多少逐浪币 
		'1000word' => 3, // 1000字多少逐浪币
	),

	// 关键词过滤相关
	'FILTER' => array(			
		'filter_scale' => 1,		// 严打时置成2
		'word_num' => 3,	// 普通过滤词 超过多少数 将作品禁封

	),

	// 书架相关
	'SHELF' => array(
		'max' => 100,			// 书架容量
		'default_num' => 0,		// 默认书架号 0
		'shelf_max' => 3,		// 用户创建的书架最大量	
	),

	// 应用app
	'APP' => array(
		'max_flower_num' => 8,	// 对每部作品最多投鲜花的数量
		'cost_num_give_flower' => 500,	// 消费多少逐浪币 给予一个鲜花
		'log_flower_rate' => 1.7,	// 日志的鲜花比例 show_num
		'min_reward_num' => 100, // 最小打赏金额
		'reward_quick_num' => array(
			100, 588, 1888, 5888, 8888, 10000, 50000, 100000
		),	// 打赏金额快捷选择

	),

	// 消费
	'COST' => array(
		'buy_type' => array(
			1 => '单章节',
			2 => '卷',
			'A' => '打赏',
		),

		'pay_type' => array(
			1 => '逐浪币',
			2 => '奖金逐浪币',
		),
	),

	// 用户相关
	'USER' => array(
		'type' => array(
			'00' => '普通会员',
			'01' => 'VIP会员',
			'02' => '普通作者',
			// '03' => '驻站作者',
			// '04' => '管理员',
		),

		'sex' => array(
			0 => '女',
			1 => '男',
		),

		// 注册类型
		'reg_type' => array(
			0 => '个性化注册',
			1 => '手机注册',
			2 => '邮箱注册',
		),

		// 用户状态
		'user_state' => array(
			0 => '正常使用',
			'N' => '待审核' // 邮箱注册用户 未激活
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

		'user_type' => array(
			'00' => '普通会员',
			'01' => 'VIP会员',
			'02' => '普通作者',
			// '03' => '驻站作者', 
			// '04' => '管理员',
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

		// 后台列表显示条数
		'list_size' => 10,

	),

	// 后台审核
	'CHECK' => array(
	
		// 审核状态 一般通用的
		'status' => array('未审核', '审核通过', '审核未通过'),

		// 作品相关时的审核状态， 由于是采用char2字段，所以单独设置一个
		'book_status' => array(
			'00' => '未审核',
			'01' => '审核通过',
			'02' => '审核未通过',
		),
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
		'read' => ZL_NGINX_MODULE.'/books/read',	// [get]读/book_id/chapter_id
		'set' => ZL_NGINX_MODULE.'/books/set',		// [post]生成/book_id/chapter_id
		'rm' => ZL_NGINX_MODULE.'/books/rm',		// [get]删除/book_id/chapter_id

		// 章节描述的字符数
		'intro_num' => 200,

		// 状态
		'status' => array(
			0 => '正常',
			1 => '关闭',
			2 => '待审核',
		),

		'vip' => array(
			0 => '普通',
			1 => 'VIP'
		),

		'lock' => array(
			0 => '未锁定',
			1 => '锁定',
		),
	),
	
	// 作品相关
	'BOOK' => array( 
		// 默认分卷
		'default_volume' => array(
			'-10' => '垃圾箱',
			'100' => '作品相关介绍',
			'1000' => '正文',
		),

		// 分卷开始id
		'start_volume' => 1000,		// 对应的是上面的 正文

		// 封面图片的大小 40kb
		'upload_max' => 40000,

		// 允许上传的图片格式
		'upload_exts' => array(
			'jpg', 'jpeg', 'gif', 'png'
		),

		// 允许推荐的最大作品书
		'recommend_max' => 5,
		// 简介最大字数限制
		'intro_max' => 200,
		
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
			// 3 => '全本申请中',
		),
		
		// // 审核状态 ? 忘了做什么的了 - -
		// // 最初是用来显示 新增作品的时候选择的审核状态，不过03为什么要有呢？
		// 'check_status' => array(
		// 	'00' => '未审核',
		// 	'01' => '审核通过',
		// 	'02' => '审核未通过',
		// 	'03' => '审核暂时通过',		// 兼容之前定义, 为什么要有这个？
		// ),

		// 作品状态
		'status' => array(
			'00' => '正常',
			'01' => '关闭',
			'02' => '待审核',
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

	) ,

	// 邮箱相关
	'EMAIL' => array(
		'host' => 'smtp.kongzhong.com',
		'username' => 'izhulang@kongzhong.com',
		'password' => 'UbNN6t3!q',
	),
);
