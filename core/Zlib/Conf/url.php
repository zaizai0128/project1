<?php
/**
 *  url设置
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-04
 * @version 1.0
 */

return array(

	/* URL设置 */
    'URL_MODEL'             =>  3,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：

    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_PATHINFO_DEPR'     =>  '/',	// PATHINFO模式下，各参数之间的分割符号
    
);