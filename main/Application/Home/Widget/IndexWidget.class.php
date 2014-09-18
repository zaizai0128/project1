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
		$book_hot_list = D('Book')->where('bk_status = "00"')->order('ch_total desc')->limit(3)->select();
		$book_full_list = D('Book')->where('bk_status = "00" and bk_fullflag=1')->order('bk_id DESC')->limit(3)->select();

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
		$book_new_list = D('Book')->where('bk_status = "00"')->order('bk_id desc')->limit(3)->select();

		$this->assign(array(
			'book_new_list' => $book_new_list,
		));
		$this->display('Widget/top_hot');
	}
}