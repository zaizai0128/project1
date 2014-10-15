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
		header('Content-type:text/html;charset='.C('SYSTEM.encoded'));

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
 * @param array | String 跳转参数
 */
if (!function_exists('ZU')) {
	function ZU($url_param, $domain = Null, $param = array())
	{	
		// 设置 存放cookie的key
		$cookie_back = 'zl_back';
		$back_url = '';

		// 设置跳转参数
		if (is_array($param) && isset($param['setback']))
		{
			cookie($cookie_back, $param['setback']);
			unset($param['setback']);

		// 说明为跳到back地址
		} else if (is_string($param) && $param = 'back') {
			$back_url = cookie($cookie_back);
			cookie($cookie_back, Null);
		}

		if (!empty($back_url)) return $back_url;

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
 * @param String 生存时间， 为 -1 则销毁session
 */
if (!function_exists('ZS')) {
	function ZS($prefix, $dot = Null, $val = Null, $life = Null)
	{
		$prefix = C($prefix);

		// 销毁session
		if (isset($life) && $life == -1) {
			return session($prefix, Null);
		}

		// 获取session
		if (!isset($val)) {
			// 判断是否存在
			if ($dot == '?') {
				return session('?'.$prefix);
			// 获取全部
			} elseif(!isset($dot)) {
				return session($prefix);
			// 获取带.的
			} else {
				return session($prefix.'.'.$dot);
			}

		// 设置session
		} else {
			// 设置带 .的
			if (isset($dot)) {
				return session($prefix.'.'.$dot, $val);
			} else {
			// 设置全部的
				session($prefix, $val);
			}
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

// by libin from old 
function z_get_initial($str) 
{
        $str = iconv("UTF-8", "GBK", $str);
        $asc = ord(substr( $str, 0, 1));
        if ($asc < 160) { // 非中文 
                if ($asc >= 48 && $asc <= 57) { // 数字
                        return "1";
                } elseif ($asc >= 65 && $asc <= 90) { // A--Z
                        return chr ( $asc );
                } elseif ($asc >= 97 && $asc <= 122) { // a--z
                        return chr ( $asc - 32 );
                } else {
                        return "}"; //其他
                }
        } else { //中文
                $asc = $asc * 1000 + ord ( substr ( $str, 1, 1 ) );
                if ($asc >= 176161 && $asc < 176197) { //获取拼音首字母A--Z
                        return "A";
                } elseif ($asc >= 176197 && $asc < 178193) {
                        return "B";
                } elseif ($asc >= 178193 && $asc < 180238) {
                        return "C";
                } elseif ($asc >= 180238 && $asc < 182234) {
                        return "D";
		} elseif ($asc >= 182234 && $asc < 183162) {
			return "E";
		} elseif ($asc >= 183162 && $asc < 184193) {
			return "F";
		} elseif ($asc >= 184193 && $asc < 185254) {
			return "G";
		} elseif ($asc >= 185254 && $asc < 187247) {
			return "H";
		} elseif ($asc >= 187247 && $asc < 191166) {
			return "J";
		} elseif ($asc >= 191166 && $asc < 192172) {
			return "K";
		} elseif ($asc >= 192172 && $asc < 194232) {
			return "L";
		} elseif ($asc >= 194232 && $asc < 196195) {
			return "M";
		} elseif ($asc >= 196195 && $asc < 197182) {
			return "N";
		} elseif ($asc >= 197182 && $asc < 197190) {
			return "O";
		} elseif ($asc >= 197190 && $asc < 198218) {
			return "P";
		} elseif ($asc >= 198218 && $asc < 200187) {
			return "Q";
		} elseif ($asc >= 200187 && $asc < 200246) {
			return "R";
		} elseif ($asc >= 200246 && $asc < 203250) {
			return "S";
		} elseif ($asc >= 203250 && $asc < 205218) {
			return "T";
		} elseif ($asc >= 205218 && $asc < 206244) {
			return "W";
		} elseif ($asc >= 206244 && $asc < 209185) {
			return "X";
		} elseif ($asc >= 209185 && $asc < 212209) {
			return "Y";
		} elseif ($asc >= 212209) {
			return "Z";
		} else {
			return "}";
		}
	}
}

function z_cut_str($string, $sublen, $start = 0, $code = 'UTF-8') 
{
        if ($code == 'UTF-8') {
                $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]";
                $pa.= "|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]";
                $pa.= "|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";

                preg_match_all( $pa, $string, $t_string );

                $size = count($t_string [0] );
                $h = "!.,?。，？";
                $i = 0;
		$max = $size > $sublen * 2 + $start ? $sublen * 2 + $start : $size;
                for ($i = $start + $sublen; $i < $max; $i++) {
                        if (strstr($h, $t_string[0][$i])) break;
                }
                if ($i < $size)
                        return join ('', array_slice($t_string [0], $start, $i - $start)) . "...";
                return join ( '', array_slice ( $t_string [0], $start, $i) );
        } else {
                $start = $start * 2;
                $sublen = $sublen * 2;
                $strlen = strlen ( $string );
                $tmpstr = '';
                for($i = 0; $i < $strlen; $i ++) {
                        if ($i >= $start && $i < ($start + $sublen)) {
                                if (ord ( substr ( $string, $i, 1 ) ) > 129) {
                                        $tmpstr .= substr ( $string, $i, 2 );
                                } else {
                                        $tmpstr .= substr ( $string, $i, 1 );
                                }
                        }
                        if (ord ( substr ( $string, $i, 1 ) ) > 129)
                                $i ++;
                }
                if (strlen ( $tmpstr ) < $strlen)
                        $tmpstr .= "......";
                return $tmpstr;
        }
}

/**
 * 截取封装函数
 */
function z_substr($str, $length, $start=0, $charset="utf-8", $suffix=true)
{
	$slice = mb_substr($str, $start, $length, $charset);
	return $suffix ? $slice.'...' : $slice;
}

function z_chen_substr($str, $start, $len)  //字符位置从0开始
{
        $strlen = strlen ( $str );
        for($i = 0; $i < $strlen; $i ++) {
                if ($i >= $start && $i < ($start + $len)) {
                        if (ord ( substr ( $str, $i, 1 ) ) > 0xa1) {
                                $tmpstr .= substr ( $str, $i, 2 );
                        } else {
                                $tmpstr .= substr ( $str, $i, 1 );
                        }
                }
                if (ord ( substr ( $str, $i, 1 ) ) > 0xa1) {
                        $i ++;
                }
        }
        return $tmpstr;
}

/**
 * 封装redirect函数
 *
 * @param string $msg 跳转提示信息
 * @param string $url 跳转的URL 通过ZU生成的url
 * @param integer $delay 延时跳转的时间 单位为秒
 * @param int 	 type 跳转的类型 默认成功1 失败-1
 */
function z_redirect($msg, $url = '', $delay = Null, $type = 1)
{
	header("Content-type:text/html;charset=".C('SYSTEM.encoded'));

	// 成功的跳转
	if ($type == 1 && !empty($url)) {
		$delay = (int)$delay;
		redirect($url,$delay,$msg);

	// 失败的跳转
	} else if(empty($url) || $type == -1) {
		// $delay = !isset($delay) ? 1 : (int)$delay ;

		// 失败及时跳转到上一页
		if (empty($delay) && empty($url)) {
			echo '<script type="text/javascript">history.go(-1);</script>';

		// 失败 返回上一页
		} else if (!empty($delay) && empty($url)) {
			$url = $_SERVER['HTTP_REFERER'];
			redirect($url, $delay, $msg);

		// 失败 跳转到指定界面
		} else {
			redirect($url, $delay, $msg);
		}
	}
	return True;
}

/**
 * 封装一下 mb_strlen函数 获取字符串长度
 *
 * @param String
 * @param String encoded
 */
function z_strlen($str, $charset=Null)
{
	$charset = isset($charset) ? $charset : C('SYSTEM.encoded') ;
	return mb_strlen($str, $charset);
}

/**
 * 获取样式服务器
 * @param String css路径
 */
function z_css($path)
{
	$path = '/css/'.$path.'.css';
	return C('ZL_STYLE_DOMAIN') . $path;
}

/**
 * 获取js
 * @param String js路径，如果为空则加载jquery
 */
function z_js($path = Null)
{
	$domain = C('ZL_STYLE_DOMAIN');

	# 为空的话，加载jquery
	if (!isset($path))
		return $domain . '/js/jquery.min.js';
	$path = $domain . '/js/' . $path . '.js';
	return $path;
}

/**
 * 获取img
 * @param String img路径
 * @param String 图片后缀，默认为 jpeg
 */
function z_img($path, $fix = 'jpg')
{
	$domain = C('ZL_STYLE_DOMAIN');
	$path = $domain . '/images/' . $path . '.' . $fix;
	return $path;
}

/**
 * 获取上一页地址
 * @param now 当前页地址 默认返回上一页
 */
function z_referer($now = False)
{
	if ($now)
		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	return $_SERVER['HTTP_REFERER'];
}

/**
 * 获取ip地址
 */
function z_ip()
{
	return $_SERVER['REMOTE_ADDR'];
}

/**
 * 获取作品封面地址
 */
function z_cover($book_id = Null, $cover = 1, $site = 0)
{
	return \Zlib\Api\Book::getCover($book_id, $cover, $site);
}