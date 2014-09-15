<?php
/**
 *  系统常量设置
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-04
 * @version 1.0
 */

return array(
	
	'ZL_DOMAIN' => 'http://zhulang.ne',					// 主站域名
	'ZL_AUTHOR_DOMAIN' => 'http://author.zhulang.ne',	// 作者站域名
	'ZL_ADMIN_DOMAIN' => 'http://admin.zhulang.ne',		// 管理站域名
	'ZL_DOMAIN_DOT' => '.zhulang.ne',

	// 用户相关
	'USER' => array(
		'type' => array(
			'00' => '普通会员',
			'01' => 'VIP会员',
			'02' => '普通作者',
			'03' => '驻站作者',
			'04' => '管理员',
		),
	),

	// 申请相关
	'APPLY' => array(

		// 申请作品允许上传的最多章节数
		'max_chapter_num' => 3,

	),
	
	// 作品相关
	'BK' => array(

		// 授权等级 -- 新建作品时候的授权等级
		'auth_level' => array(
			1 => '首发作品',
			2 => '驻站作品',
			3 => '公众作品',
		),

		// 作品连载属性
		'serial_status' => array(
			0 => '连载',
			1 => '全本',
			2 => '封笔',
		),

		// 审核状态
		'check_status' => array(
			'00' => '未审核',
			'01' => '审核通过',
			'02' => '审核未通过',
		),

		// 签约类型
		'commision' => array(
			'A' => 'A',
			'B' => 'B',
			'C' => 'C',
			'D' => 'D',
			'E' => 'E',
			'T' => 'T',
			'X' => 'X',
			'Y' => 'Y',
			'Z' => 'Z',
		),

		// 签约类型
		'commision' => array(
			'A' => 'A',
			'B' => 'B',
			'C' => 'C',
			'D' => 'D',
			'E' => 'E',
			'T' => 'T',
			'X' => 'X',
			'Y' => 'Y',
			'Z' => 'Z',
		),
	)
);