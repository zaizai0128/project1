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
	
	// 临时的导航数组，后期存放到数据库中
	'menu_category' => array(

		// 顶级菜单
		1 => array(
			'id' => '1',
			'name' => '首页',
			'show' => 1,
			'controller' => 'Index',
			'action' => 'index',
			'url' => 'http://admin.zhulang.ne/index/index/gcid/1.html',

			// 左侧菜单
			'children' => array(
				array(
					'id' => '10',
					'name' => '设置',
					'show' => 1,

					// 左侧子菜单
					'item' => array(
						array(
							'id' => '101',
							'name' => '网站管理',
							'url' => 'http://admin.zhulang.ne/setting/index/gcid/101.html',
						),
						array(
							'id' => '102',
							'name' => '安全管理',
							'url' => 'http://admin.zhulang.ne/anquan/index/gcid/102.html',
						),
					),
				),
			),
		),

		2 => array(
			'id' => '2',
			'name' => '作品',
			'show' => 1,
			'controller' => 'Book',
			'action' => 'index',
			'url' => 'http://admin.zhulang.ne/book/index/gcid/2.html',
			'children' => array(
				array(
					'id' => '20',
					'name' => '待审核列表',
					'show' => 1,
					'item' => array(
						array(
							'id' => '201',
							'name' => '作品申请列表',
							'url' => 'http://admin.zhulang.ne/bookApply/index/gcid/201.html',
						),
						array(
							'id' => '202',
							'name' => '章节审核列表',
							'url' => 'http://admin.zhulang.ne/anquan/index/gcid/202.html',
						),
					),
				),
				array(
					'id' => '21',
					'name' => '作者申请列表',
					'show' => 1,
					'item' => array(
						array(
							'id' => '211',
							'name' => '申请列表',
							'url' => 'http://admin.zhulang.ne/setting/index/gcid/211.html',
						),
						array(
							'id' => '212',
							'name' => '申请失败列表',
							'url' => 'http://admin.zhulang.ne/anquan/index/gcid/212.html',
						),
					),
				),
			),
		),

	),
	     
);

return array_merge($zlib_config, $app_config);