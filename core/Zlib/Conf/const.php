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
			'LOG_DEFAULT' => 'default',			// 默认日志，暂时未知
			'LOG_BUY' => 'buy',				// 购买日志
			'LOG_COST' => 'cost',			// 消费日志
			'LOG_APP' => 'app',				// 应用日志，鲜花，打赏等
			'LOG_USER' => 'user',			// 用户日志，登录，修改密码等
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
		'reward_quick_num' => array( // 打赏金额快捷选择
			100, 588, 1888, 5888, 8888, 10000, 50000, 100000
		),	
	),

	// 消费
	'COST' => array(
		'buy_type' => array(
			1 => '单章节',
			2 => '卷',
			'A' => '打赏',
		),

		'money_type' => array(
			1 => '逐浪币',
			2 => '奖金逐浪币',
		),

		'duration' => 100,	// 消费日志，一次卷消费，分段章节数
	),

	// 充值
	'RECHARGE' => array(
		// 充值类型 一级分类
		'type' => array(
			0 => '支付宝',
			1 => 'RDO',
			2 => '等等其他待定',

			10 => '客服调整',
			11 => '系统调整',	// 系统自动调整（过期）
		),

		// 充值类型 二级分类
		'sub_type' => array(
			10 => 'xx原因调整',
		),
	),

	// 用户相关
	'USER' => array(

		'type' => array(
			'00' => '普通会员',
			'01' => 'VIP会员',
			'02' => '普通作者',
			// '03' => '驻站作者', // 取消掉该状态，只有普通作者
			'04' => '管理员',
		),

		'user_type' => array(
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

		// 审核类型 zl_audit类型
		'type' => array(
			1 => '作品全本',
			2 => '作品封面',
			3 => '作品名',
			4 => '作品介绍',
			5 => '书评',
			6 => '用户昵称',
			7 => '作品封笔',
		),

		// 审核级别
		// 数值越大，紧急程度越高
		'level' => array(
			0 => '普通',
			5 => '高急',
			9 => '紧急',
		),

		'chapter_level' => array(
			0 => '普通',
			1 => '严重',
			2 => '政治',
		),

		// 状态
		'status' => array(
			0 => '未审核',
			1 => '通过',
			2 => '拒绝',
		),
	),

	// 作者
	'AUTHOR' => array(

		'max_book_apply_day' => 3,	// 每天允许最多申请作品个数？

		'chapter_list_size' => 10, // 正式作品章节的列表条数 ， 好像没有用到

		'auther_com_ban_words' => array(  // 推荐作品禁止包含
			'中国作者素材库', 
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

		// 章节描述的字符数，不是很有必要吧
		'intro_num' => 200,

		// 状态
		'status' => array(
			0 => '正常',				// 正常
			1 => '删除',				// 章节删除				
			2 => '待审核',			// 兼容之前的
			3 => '待审核',			// 情节轻一点，允许前台查看，只不过后台会进入到审核列表
			4 => '屏蔽',				// 情节严重，同时会封作品。（如，发布了涉及政治敏感话题）
		),

		'vip' => array(
			0 => '普通',
			1 => 'VIP'
		),

		// 章节锁定，编辑章节的时候，给予该状态。禁止其他人修改。
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

		// 作品状态
		'status' => array(
			'00' => '正常',			
			'01' => '删除',			// 作品删除状态
			'02' => '删除',			// 兼容之前的状态 --> 等同于删除
			'03' => '屏蔽',			// 作品屏蔽列表（后台，添加了屏蔽里以后，会将作品改为该状态）
			'04' => '作者站关闭',		// 禁止作者编辑（当该作者上传了严重违规的章节后，会被封闭作品）
		),

		// 签约类型
		// 后台显示 name 其他地方显示show
		'commision' => array(
			'A' => array("name" => "A级签约", "show" => 'A级签约作品' ),
			'B' => array("name" => "准A级签约", "show" => "本站首发" ),
			'C' => array("name" => "C级签约", "show" => "驻站作品" ),
			'D' => array("name" => "D级作品", "show" => "驻站作品" ),
			'E' => array("name" => "E级作品", "show" => "公众作品" ),
			'T' => array("name" => "申请签约中", "show" => "申请签约中" ), // 临时状态，申请签约中...
			'X' => array("name" => "X级签约", "show" => "联盟作品" ),
			'Y' => array("name" => "Y级签约", "show" => "A级签约作品" ),
			'Z' => array("name" => "Z级签约", "show" => "A级签约作品" ),
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

	// 手机短信接口
	'MOBILE' => array(
		'msg_api' => 'http://202.108.24.207/sendmt.jsp?mobile={%s}&mt=您的逐浪网验证码为{%s}，请勿泄露。如非本人操作请回复N屏蔽。客服电话025-66670800&qxtId=D69DDE250CCFB24377925486579BFC9F',
	),
);
