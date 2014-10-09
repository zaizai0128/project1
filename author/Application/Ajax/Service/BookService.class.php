<?php
/**
 * 作品 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Ajax\Service;
use Zlib\Model\ZlibBookModel;
use Zlib\Model\ZlibBookApplyModel;

class BookService {

	protected $bookInstance = Null;
	protected $bookApplyInstance = Null;

	public function __construct()
	{
		$this->bookInstance = new ZlibBookModel;
		$this->bookApplyInstance = new ZlibBookApplyModel;
	}

	/**
	 * 判断作品名是否存在
	 * @param string book_name
	 */
	public function bookNameExists($book_name)
	{
		$result = array();
		$result = $this->bookInstance->getBookByName($book_name, 'bk_id');

		if (!empty($result))
			return z_info(-1, '作品名已存在');

		$result = array();
		$result = $this->bookApplyInstance->getApplyBookByName($book_name, 'bk_id');

		if (!empty($result))
			return z_info(-1, '作品名已存在');

		return z_info(1, '作品名不存在，可以继续');
	}

}