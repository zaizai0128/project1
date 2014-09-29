<?php
/**
 * 应用公共配置文件
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */

// 加载zlib配置文件
$zlib_config = require(ZLIB_PATH . '/Conf/config.php');

$app_config = array(
	
	
	// 设置module列表
    'MODULE_ALLOW_LIST' => array('Home', 'User', 'Buy', 'Ajax', 'App'),        
);

return array_merge($zlib_config, $app_config);