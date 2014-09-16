<?php
/**
 *  配置选项
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */

// 加载扩展配置文件，依次是数据库，缓存，系统常量，session，url，url路由
$db_conf = require(ZLIB_PATH . '/Conf/db.php');
$cache_conf = require(ZLIB_PATH . '/Conf/cache.php');
$const_conf = require(ZLIB_PATH . '/Conf/const.php');
$session_conf = require(ZLIB_PATH . '/Conf/session.php');
$url_conf = require(ZLIB_PATH . '/Conf/url.php');
$route_conf = require(ZLIB_PATH . '/Conf/route.php');

$main_config = array(

    // 增加模板解析变量
    'TMPL_PARSE_STRING' => array(
        '__JS__' => '/Public/js',   // js
        '__CSS__' => '/Public/css',   // css
        '__STYLE__' => '/Public/style',   // style
        '__UPLOAD__' => '/Uploads',   // upload
    ),

    // 注册新的命名空间
    'AUTOLOAD_NAMESPACE' => array(
        // 逐浪公共类库
    	'Zlib' => ZLIB_PATH,
    ),
);

return array_merge($main_config, $db_conf, $cache_conf, $const_conf, $session_conf, $url_conf, $route_conf);