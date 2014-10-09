<?php
/**
 * 作品 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-24
 * @version 2.0
 */
namespace Home\Service;
use Zlib\Model\ZlibBookModel;

class BookService extends ZlibBookModel {
	
	/**
	 * 执行编辑作品信息
	 *
	 * @param array $data
	 */
	public function doEditBookInfo($data)
	{
		if (empty($data['bk_id'])) return z_info(-1, '作品不存在');
		
		$book_info = parent::getBookByBookId($data['bk_id']);
		
		if ($book_info['bk_status'] != '00') return z_info(-2, '禁止修改');
		if ($book_info['bk_fullflag'] != 0) return z_info(-3, '完结作品，禁止修改');

		$com = explode(' ', $data['com_txt']);
		if (count($com) > C('BOOK.recommend_max')) return z_info(-4, '超过最大推荐作品数量');
		
		$intro_strlen = z_strlen($data['intro']);
		if ($intro_strlen > C('BOOK.intro_max')) return z_info(-5, '简介超过最大字数');

		// 一些基础验证 ...

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['bk_fullflag'] = $data['fullflag'];
		$final_data['bk_tag'] = $data['tag'];
		$final_data['bk_intro'] = $data['intro'];
		$final_data['bk_author_com_txt'] = $data['com_txt'];
		$final_data['bk_author_com_book'] = $data['bk_author_com_book'];
		$result = parent::doEdit($final_data);
		
		if ($result > 0) {
			return z_info($result, '修改成功');
		} else {
			return z_info(0, '修改失败');
		}
	}
}