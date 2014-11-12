<?php
/**
 * 作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Book\Service;
use Zlib\Model\ZlibBookModel;

class BookService extends ZlibBookModel {

	/**
	 * 修改作品信息
	 */
	public function doEditInfo($data)
	{
		$rs = parent::doEdit($data);
		return $rs ? z_ajax_info(1, '修改成功') : z_ajax_info(0, '修改失败');
	}

	/**
	 * 删除作品
	 */
	public function delBook($book_id)
	{
		// 判断该作品下面是否有vip章节，如果有则无法删除
		$chapter = D('Chapter', 'Service');
		$chapter = $chapter->getInstance($book_id);
		$vip_num = $chapter->getTotalVipChapterNum();
		
		if ($vip_num>0)
			return z_ajax_info(-1, '有vip章节，禁止删除作品');

		$rs = parent::del($book_id);
		return $rs ? z_ajax_info(1, '删除成功') : z_ajax_info(0, '删除失败');
	}


}