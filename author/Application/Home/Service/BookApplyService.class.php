<?php
/**
 * 申请作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-24
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibBookApplyModel;

class BookApplyService extends ZlibBookApplyModel {

	/**
	 * 新建作品
	 */
	public function doAdd($data)
	{
		if (empty($data['bk_name'])) return z_info(-1, '作品名不能为空');
		if (empty($data['bk_class_id'])) return z_info(-2, '作品id不能为空');
		if (empty($data['author_name'])) return z_info(-3, '作者笔名不能为空');
		// 检测是否含有关键字 ...

		// 查找作品是否重名
		if(!$this->_checkBookName($data['bk_name'])) 
			return z_info(-4, '作品名已经存在');

		$final_data['bk_cre_time'] = z_now();
		$final_data['bk_name'] = $data['bk_name'];
		$final_data['bk_author_id'] = $data['user_id'];
		$final_data['bk_author'] = $data['author_name'];
		$final_data['bk_accredit'] = $data['bk_accredit'];
		$final_data['bk_class_id'] = $data['bk_class_id'];
		$final_data['bk_tag'] = $data['bk_tag'];
		$final_data['bk_size'] = 0;
		$final_data['bk_intro'] = $data['bk_intro'];
		$final_data['bk_now_date'] = z_now();
		$final_data['bk_apply_status'] = '00';
		$final_data['ch_total'] = 0;

		$book_id = parent::doAdd($final_data);

		if ($book_id > 0)
			return z_info($book_id, '添加成功');
		else
			return z_info(0, '添加失败');
	}

	/**
	 * 判断作品名是否重名
	 *
	 */
	private function _checkBookName($book_name)
	{	
		$book = parent::getApplyBookByName($book_name, 'bk_id');
		if (!empty($book)) return False;

		$book = D('Book', 'Service')->getBookByName($book_name, 'bk_id');
		if (!empty($book)) return False;

		return True;
	}

}