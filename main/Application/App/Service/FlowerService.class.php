<?php
/**
 * 鲜花 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace App\Service;
use Zlib\Model\ZlibBookModel;

class FlowerService extends ZlibBookModel {

	/**
	 * 获取用户对每本书的鲜花
	 *
	 * @param user_id
	 * @param book_id
	 */
	public function getFlower($user_id, $book_id)
	{
		$result = array();
		$result['have_num'] = 3;
		$result['allow_num'] = 2;

		return $result;
	}

	/**
	 * 添加鲜花操作
	 */
	public function addFlower($data)
	{
		// 一些基础验证
		$have_num = $data['user_info']['flower']['have_num'];
		$allow_num = $data['user_info']['flower']['allow_num'];
		$num = $data['num'];

		if ($num > $have_num) {
			return z_info(-1, '您当前的鲜花数不够');

		} else if ($num > $allow_num) {
			return z_info(-2, '超过当前作品所能接受的鲜花数');
		} 

		return z_info(1, '赠送成功');
	}
	
}