<?php
/**
 * 作品的 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace App\Service;
use Zlib\Model\ZlibBookModel;

class BookService extends ZlibBookModel {

	/**
	 * 添加鲜花数
	 */
	public function addFlower($data)
	{
		// 获取作品当前的鲜花数
		$flower_data = parent::getBookRankInfo($data['bk_id'], 'bk_flower_total, bk_flower_month');

		if (empty($flower_data)) {
			$final_data['bk_flower_total'] = $data['num'];
			$final_data['bk_flower_month'] = $data['num'];
			return parent::addBookRankInfo($final_data);
		} else {
			$final_data['bk_flower_total'] = (int)($data['num'] + $flower_data['bk_flower_total']);
			$final_data['bk_flower_month'] = (int)($data['num'] + $flower_data['bk_flower_month']);
			$final_data['bk_id'] = $data['bk_id'];
			return parent::editBookRankInfo($final_data);
		}
	}
	
}