<?php
/**
 * 侧边框的weight组件
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Widget;
use Home\Controller\HomeController;

class SidebarWidget extends HomeController {

	/**
	 * 顶部的li列表，显示作者拥有的书籍权限
	 */
	public function top()
	{
		// 获取用户拥有的作品列表
		$book_list = D('Book', 'Service')->getBookByUserId($this->authorInfo['user_id'], 'bk_id,bk_name');

		$this->assign(array(
			'sidebar_top_list' => $book_list,
		));
		$this->display('Public:sidebar_top');
	}


}
