<?php
/**
 *  session设置
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-04
 * @version 1.0
 */

return array(
	
	/* SESSION设置 */
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
    'SESSION_OPTIONS'       =>  array(), // session 配置数组 支持type name id path expire domain 等参数
    'SESSION_TYPE'          =>  'Memcache', // session hander类型 默认无需设置 除非扩展了session hander驱动
    'SESSION_PREFIX'        =>  '', 	// session 前缀

);