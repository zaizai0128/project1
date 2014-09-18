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
		else
			$txt = $var;

		dump($txt);
		die;
	}
}

/**
 * 生成带有域名的绝对URL路径(封装一下U方法)
 *
 * @param String U方法传递参数
 * @param String 域名的配置名
 */
if (!function_exists('ZU')) {
	function ZU($url_param, $domain = Null, $param = array())
	{
		$url_param = '/'.ltrim($url_param, '/');
		$http = empty($domain) ? C('ZL_DOMAIN') : !C($domain) ? C('ZL_DOMAIN') : C($domain);
		return $http . U($url_param, $param);
	}
}

/**
 * 获取通过C方法获取的常量数组的元素
 *
 * @param Array 数组
 * @param int|String 数组下标
 */
if (!function_exists('ZC')) {
	function ZC($arr, $key)
	{
		return isset($arr[$key]) ? $arr[$key] : False;
	}
}

/**
 * 获取通过设置的常量，获取session的值
 *
 * @param String C方法获取的session前缀
 * @param String session方法正常获取方法  .分割
 * @param string 设置的值
 */
if (!function_exists('ZS')) {
	function ZS($prefix, $dot, $val = Null)
	{
		if (!isset($val))
			return session(C($prefix).'.'.$dot);
		else
			return session(C($prefix).'.'.$dot, $val);
	}
}

/**
 * 传递作品本身的分类，和全部顶级分类，生成该作品对应的短分类
 *
 * @param String 作品分类id
 * @param Array  顶级分类
 * @return Array 返回该顶级分类信息
 */
if (!function_exists('z_get_short_category')) {
	function z_get_short_category($book_class_id, $top_class)
	{
		if (strlen($book_class_id) > 2)
			$book_class_id = substr($book_class_id, 0, 2);
		return $top_class[$book_class_id];
	}
}