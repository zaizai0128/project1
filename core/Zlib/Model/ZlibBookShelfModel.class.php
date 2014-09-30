<?php
/**
 * 书架 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-30
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookShelfModel extends BaseModel {

	protected $userId = Null;
	protected $shelfId = Null;
	protected $shelfInstance = Null;

	public function getInstance($userId, $shelfId = Null)
	{
		$this->userId = $userId;
		$this->shelfId = $shelfId;
		$this->shelfInstance = M($this->_getTableName());
		return $this;
	}

	private function _getTableName()
	{
		return 'zl_bookshelf_'.sprintf('%02d', $this->userId % 10);
	}

	/**
	 * 获取书架总数
	 * @param int 书架id
	 * @return int 
	 */
	public function getTotalBooks($shelf_id = Null)
	{
		if (isset($shelf_id)) {

			$condition = 'bookshelf_id = '.$shelf_id;
			$shelf = $this->shelfInstance->where($condition)->select();
		} else {

			$shelf = $this->shelfInstance->select();
		}

		$all_books = array();
		foreach($shelf as $val) {
			$books = json_decode($val['books'], True);
			$all_books = array_merge($all_books, $books);
		}
		$all_books = array_unique($all_books);
		return count($all_books);
	}

}