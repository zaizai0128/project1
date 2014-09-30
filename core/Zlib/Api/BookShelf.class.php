<?php
/**
 * 公共的作者api接口
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 * 先实现数据库读取，之后实现memcache加载和更新
 */
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class BookShelf {
	
	private $mUserId = null;
	public $mBookShelf = null;
	private $mMaxShelf = 3;	// 最大书架分类

	public function __construct($user_id)
	{	
		$this->mUserId = $user_id;		
		$this->loadFromDatabase();
	}

	private function loadFromDatabase() 
	{	
		$bookids = '';
		$mod = $this->mUserId % 10;
		
		$m = M('zl_bookshelf_0'.$mod)->where('user_id = '.$this->mUserId)->order('bookshelf_id asc')->select();
		foreach ($m as $row) {
			$arr = json_decode($row['books'], true);	
			$row['books'] = $arr;
			$size = count($arr);
			for ($i = 0; $i < $size; $i++) { 
				if (!Book::isCached($arr[$i])) {
					$bookids.= $arr[$i] . ",";
				}
			}
			$this->mBookShelf[$row['bookshelf_id']] = $row;
		}
		$bookids[strlen($bookids) - 1] = ' ';

		$m = M('zl_book')->where(' bk_id in ('.$bookids.')')->select();
		foreach ($m as $row) {
			new Book($row['bk_id'], false, $row);
		}
		
		return true;
	}

	private function getShelfInfo($shelf_id) 
	{
		return $this->mBookShelf[$shelf_id];
	}

	public function getBooks($shelf_id) 
	{
		$arr = array();
		$size = count($this->mBookShelf[$shelf_id]['books']);
		for ($i = 0; $i < $size; $i++) {
			$book = new Book($this->mBookShelf[$shelf_id]['books'][$i]);
			$arr[$i] = $book->getInfo();
		}
		return $arr;
	}

	private function getBooksLimit($shelf_id, $from, $to) 
	{
		$arr = array();
		$size = count($this->mBookShelf[$shelf_id]['books']);
		for ($i = $from; $i < $to; $i++) {
			$book = new Book($this->mBookShelf[$shelf_id]['bookshelf_id']);
		}
		return $arr;
	}


	public function addBook($shelf_id, $book_id) 
	{
		if ($shelf_id < 0 || $shelf_id > $this->mMaxShelf)
			return false;
		$row = $this->mBookShelf[$shelf_id];
		if ($row == null) {
			$row = array();
			$row['user_id'] = $this->mUserId;
			$row['book_shelf_id'] = $shelf_id;
			$row['bookshelf_name'] = '书架'.($shelf_id + 1);
			$row['books'] = array();
			$this->mBookShelf[$shelf_id] = $row;
		}
		if (!in_array($book_id, $row['books'])) {
			array_push($this->mBookShelf[$shelf_id]['books'],  $book_id);	
			$row = array();
			$row['user_id'] = $this->mUserId;
			$row['bookshelf_id'] = $shelf_id;
			$row['bookshelf_name'] = $this->mBookShelf[$shelf_id]['bookshelf_name'];
			$row['books'] = json_encode($this->mBookShelf[$shelf_id]['books']);
			M('zl_bookshelf_0'.($this->mUserId % 10))->add($row, array(), true);
		}
		return true;
	}

	public function removeBook($shelf_id, $book_id) 
	{
		$size  = count($this->mBookShelf[$shelf_id]['books']);
		$found = false;
		for ($i = 0; $i < $size; $i++) {
			if ($this->mBookShelf[$shelf_id]['books'][$i] == $book_id) {
				array_splice($this->mBookShelf[$shelf_id]['books'], $i, 1);
				print_r($this->mBookShelf);
				$found = true;
				break;
			}
		}
		if ($found) {
			$row = array();
			$row['user_id'] = $this->mUserId;
			$row['bookshelf_id'] = $shelf_id;
			$row['bookshelf_name'] = $this->mBookShelf[$shelf_id]['bookshelf_name'];
			$row['books'] = json_encode($this->mBookShelf[$shelf_id]['books']);
			M('zl_bookshelf_0'.($this->mUserId % 10))->add($row, array(), true);
		}
	}
}
