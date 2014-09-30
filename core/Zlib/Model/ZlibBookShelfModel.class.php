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
	 * 创建书架
	 */
	public function doAdd()
	{
		$max_id = $this->getMaxId();
		++$max_id;
		// 超过最大限制，则返回false
		if ($max_id >= C('SHELF.shelf_max'))
			return false;

		$data['user_id'] = $this->userId;
		$data['bookshelf_id'] = $max_id;
		++$max_id;
		$data['bookshelf_name'] = '书架'.$max_id;
		$data['books'] = '';
		return $this->shelfInstance->data($data)->add();
	}

	/**
	 * 修改书架
	 */
	public function doEdit($data)
	{	
		$condition = 'user_id = '.$data['user_id'].' and bookshelf_id = '.$data['bookshelf_id'];
		return $this->shelfInstance->where($condition)->data($data)->save();
	}

	/**
	 * 获取最大书架号
	 */
	public function getMaxId()
	{
		$condition = 'user_id = '.$this->userId;
		return $this->shelfInstance->where($condition)->max('bookshelf_id');
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