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

/**
 * 生成带有域名的绝对URL路径(封装一下U方法)
 *
 * @param String U方法传递参数
 * @param String 域名的配置名
 */
if (!function_exists('CU')) {
	function CU($url_param, $domain = Null)
	{
		$http = !$domain ? C('ZL_DOMAIN') : !C($domain) ? C('ZL_DOMAIN') : C($domain);
		return $http . U($url_param);
	}
}