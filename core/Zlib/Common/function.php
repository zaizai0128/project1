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
	function ZS($prefix, $dot = Null, $val = Null)
	{
		if (!isset($val)) {
			if ($dot == '?') {
				return session('?'.C($prefix));
			} elseif(!isset($dot)) {
				return session(C($prefix));
			} else {
				return session(C($prefix).'.'.$dot);
			}
		} else {
			return session(C($prefix).'.'.$dot, $val);
		}
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

/**
 * 通过作品的字数获取该作品所需的逐浪币为多少
 *
 * @param int word_num
 * @param int 活动类型 不同活动对应不同的价格促销
 */
if (!function_exists('z_word_to_money')) {
	function z_word_to_money($word_num, $active_type = 0)
	{
		$price = ceil( $word_num / 1000 * C('MONEY.1000word') );
		return $price;
	}
}

/**
 * curl 模拟post提交
 *
 * @param String $url
 * @param Array $post
 */
if (!function_exists('z_request_post')) {
	function z_request_post($url, $post)
	{
		if (is_array($post))
			$post = http_build_query($post);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, True);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$info = curl_exec($ch);
		curl_close($ch);
		
		return $info;
	}
}

/**
 * service层 返回的状态码，以及说明
 *
 * @param int code 信息码
 * @param String 信息提示
 * @return array('code'=>信息码, 'msg'=>信息提示);
 */
function z_info($code, $msg)
{
	return array('code'=>$code, 'msg'=>$msg);
}

/**
 * 获取当前时间
 */
function z_now()
{
	return date('Y-m-d H:i:s', time());
}

/**
 * 验证验证码
 *
 * @param code
 * @param id
 */
function z_check_verify($code, $id = '')
{
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}