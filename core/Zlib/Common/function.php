<?php
/**
 * 公共函数
 * 函数的命名 使用 下划线分割
 * 方法的命令 使用驼峰
 * ---- 参考think手册
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-05
 * @version 1.0
 */

/**
 * 调试函数
 * 
 * @param  参数类型 参数名称
 * @return 返回类型 
 */
if (!function_exists('de')) {
	function de($var = Null)
	{
		if (!isset($var))
			$txt = 'going...here';

		dump($var);
		die;
	}
}