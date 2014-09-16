<?php
/**
 * 逐浪小说网 作者站入口文件
 * ThinkPHP3.2.2+版本 要求php环境必须大于5.3
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */

// ------------------------------------------------------ 系统调试参数
define('APP_DEBUG',True);			// 开启调试模式 正式环境改为False
define('BUILD_DIR_SECURE', False);	// 禁止生成安全目录 正式环境改为True

// ------------------------------------------------------ 必须定义的常量 系统级
define('ROOT_PATH', dirname(__DIR__) . '/');		// 定义根目录
define('THINK_PATH', ROOT_PATH . 'core/ThinkPHP/'); // 定义thinkphp目录
define('ZLIB_PATH', ROOT_PATH . 'core/Zlib');		// 定义Zlib类库目录, 用来设置Zlib命名空间


// ------------------------------------------------------ 必须定义的常量 应用级
define('APP_PATH', __DIR__ . '/Application/');		// 定义应用目录
define('RUNTIME_PATH',   __DIR__ . '/Runtime/');	// 定义应用的缓存目录
define('HTML_PATH', __DIR__ . '/Html/');			// 定义应用生成的静态目录
define('PUBLIC_MODULE_PATH', APP_PATH . 'Public');	// 定义公共模块的目录

// ------------------------------------------------------- 模块级
define('BIND_MODULE', 'Home');	// 如果只有一个模块，可以这样做

require THINK_PATH . 'ThinkPHP.php';				