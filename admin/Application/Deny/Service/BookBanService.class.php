<?php
/**
 * bookBan service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Deny\Service;
use Zlib\Model\ZlibBookBanListModel;
use Zlib\Api\BookBan;

class BookBanService extends ZlibBookBanListModel {

	protected $banInstance = Null;
	protected $type = Null;

	public function __construct()
	{
		parent::__construct();
		$this->banInstance = BookBan::getInstance();
	}

	/**
	 * 添加禁止作品
	 */
	public function doAddBan($data)
	{
		$data['ban_start'] = empty($data['ban_start']) ? date('Y-m-d', time()) : $data['ban_start'];
		$data['ban_end'] = empty($data['ban_end']) ? date('Y-m-d', time()) : $data['ban_end'] ;

		if ($data['ban_start'] > $data['ban_end']) {
			$tmp = $data['ban_start'];
			$data['ban_start'] = $data['ban_end'];
			$data['ban_end'] = $tmp;
		}	

		$data['ban_start'] .= ' 00:00:00';
		$data['ban_end'] .= ' 23:59:59';

		$books = explode('|', trim($data['books'], '|'));

		if (empty($books))
			return z_ajax_info(-1, '书号不允许为空');

		$now = z_now();
		$book_list = array();
		foreach ($books as $key => $val) {
			$book_list[$key]['bk_id'] = $val;
			$book_list[$key]['ban_type'] = parent::getType();
			$book_list[$key]['ban_start'] = $data['ban_start'];
			$book_list[$key]['ban_end'] = $data['ban_end'];
			$book_list[$key]['insert_time'] = $now;
			$book_list[$key]['status'] = 1;
			$book_list[$key]['ban_reason'] = $data['ban_reason'];
		}

		$this->banInstance->addBanList($book_list);
		
		return z_ajax_info(1, '添加成功');
	}

	/**
	 * 添加屏蔽作品 比较特殊，不加时间
	 */
	public function doAddDeny($data)
	{
		$books = explode('|', trim($data['books'], '|'));

		if (empty($books))
			return z_ajax_info(-1, '书号不允许为空');

		$now = z_now();
		$book_list = array();
		foreach ($books as $key => $val) {
			$book_list[$key]['bk_id'] = $val;
			$book_list[$key]['ban_type'] = parent::getType();
			$book_list[$key]['insert_time'] = $now;
			$book_list[$key]['status'] = 1;
			$book_list[$key]['ban_reason'] = $data['ban_reason'];
		}

		$this->banInstance->addBanList($book_list);
		
		return z_ajax_info(1, '添加成功');
	}


}