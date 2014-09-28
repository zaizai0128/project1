<?php
/**
 * 首页分块数据
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Widget;
use Home\Controller\HomeController;

class IndexWidget extends HomeController {

	/**
	 * 顶部左侧
	 */
	public function topLeft()
	{
		$book_hot_list = M('ZlBook')->where('bk_status = "00" AND bk_id BETWEEN 270000 AND 279999')->order('ch_total desc')->limit(50)->select();
		$book_full_list = M('ZlBook')->where('bk_status = "00" and bk_fullflag=1 AND bk_id BETWEEN 270000 AND 279999')->order('bk_id DESC')->limit(50)->select();

		$this->assign(array(
			'top_left_hot' => $book_hot_list,
			'top_left_full' => $book_full_list,
		));
		$this->display('Widget/top_left');
	}

	/**
	 * 顶部热门推荐
	 */
	public function topHot()
	{
		$book_new_list = M('ZlBook')->where('bk_status = "00"')->order('bk_id desc')->limit(50)->select();

		$this->assign(array(
			'book_new_list' => $book_new_list,
		));
		$this->display('Widget/top_hot');
	}
}