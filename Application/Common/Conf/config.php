<?php
return array(
    // url
    'URL_MODEL'             =>  2,
	//'配置项'=>'配置值'
	'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'lagou',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'lg_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
	'SHOW_PAGE_TRACE' 		=>	true,				//开启页面trace
	'DOMAIN'                =>  'http://lagou.me',
	'WEB_NAME'				=>	'拉勾',
    
    'DEFAULT_FILTER'        =>  'htmlspecialchars,trim', // 默认参数过滤方法 用于I函数...
    'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
    'DEFAULT_MODULE'       =>    'Home',

    // email配置
    'email_host' => 'smtp.163.com',
    'email_port' => 25,
    'email_username' => 'lamp_testmail@163.com',
    'email_pwd' => 'abc123456',
    'email_fromname' => '拉勾网',

    // 公司的配置文件
    // 公司的规模
    'company_scale' => array(
        0 => '少于15人',
        1 => '15-50人',
        2 => '50-150人',
        3 => '150-500人',
        5 => '500-2000人',
        6 => '2000人以上',
    ),

    // 公司发展阶段
    'company_stage' => array(
        0 => '天使轮',
        1 => 'A轮',
        2 => 'B轮',
        3 => 'C轮',
        4 => 'D轮及以上',
        5 => '上市公司',
        6 => '不需要融资',
    ),

    // 企业状态
    'company_state' => array(
        -1 => '未验证',
        0 => '禁用',
        1 => '已认证',
        2 => '未认证'
    )
);