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
	public $mBooks = null;
	private $mMaxShelf = null;	// 最大书架分类

	public function __construct($user_id)
	{	
		$this->mUserId = $user_id;
		$this->mMaxShelf = C('SHELF.shelf_max');
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
				if (!Book::isCached($arr[$i]['bk_id'])) {
					$bookids.= $arr[$i]['bk_id'] . ",";
				}
				$this->mBooks[$arr[$i]['bk_id']] = $row['bookshelf_id'];
			}
			$this->mBookShelf[$row['bookshelf_id']] = $row;
		}
		// print_r($this->mBooks);
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

	/**
	 * 获取书架列表
	 */
	public function getShelfList()
	{
		$result = array();

		foreach($this->mBookShelf as $key => $val) {
			$result[$val['bookshelf_id']] = $val['bookshelf_name'];
		}
		return $result;
	}

	public function getBooks($shelf_id) 
	{
		$arr = array();
		$size = count($this->mBookShelf[$shelf_id]['books']);
		for ($i = 0; $i < $size; $i++) {
			$book = new Book($this->mBookShelf[$shelf_id]['books'][$i]['bk_id']);
			$info =  $book->getInfo();
			$info['bookmark'] =  $this->mBookShelf[$shelf_id]['books'][$i]['ch_id'];
			array_push($arr, $info);
		}
		return $arr;
	}

	private function getBooksLimit($shelf_id, $from, $to) 
	{
		$arr = array();
		$size = count($this->mBookShelf[$shelf_id]['books']);
		for ($i = $from; $i < $to; $i++) {
			$book = new Book($this->mBookShelf[$shelf_id]['bookshelf_id']['bk_id']);
			$info =  $book->getInfo();
			$info['bookmark'] =  $this->mBookShelf[$shelf_id]['books'][$i]['ch_id'];
			array_push($arr, $info);
		}
		return $arr;
	}


	public function addBook($shelf_id, $book_id, $ch_id = -1) 
	{
		if ($shelf_id < 0 || $shelf_id > $this->mMaxShelf)
			return false;

		if ($this->mBooks[$book_id] != null)
			return false;		// 已存在
		$row = $this->mBookShelf[$shelf_id];
		if ($row == null) {
			$row = array();
			$row['user_id'] = $this->mUserId;
			$row['bookshelf_id'] = $shelf_id;
			if ($shelf_id == 0)
				$row['bookshelf_name'] = '默认书架';
			else 
				$row['bookshelf_name'] = '书架'.$shelf_id;
			$row['book_amount'] = 0;
			$row['books'] = array();
			$this->mBookShelf[$shelf_id] = $row;
		}	
		 
		$temp = array();
		$temp['bk_id'] = $book_id;
		$temp['ch_id'] = $ch_id;
		array_push($this->mBookShelf[$shelf_id]['books'],  $temp);
		$this->mBookShelf[$shelf_id]['book_amount']++;

		$row['books'] = json_encode($this->mBookShelf[$shelf_id]['books']);
		$row['book_amount']++;
		M('zl_bookshelf_0'.($this->mUserId % 10))->add($row, array(), true);
		return true;
	}

	public function updateBookMark($book_id, $ch_id) 
	{	
		$shelf_id = $this->mBooks[$book_id];
		if ($shelf_id == null) {
			$shelf_id = 0;
			$this->addBook($shelf_id, $book_id, $ch_id);
		} else {

			$row = $this->mBookShelf[$shelf_id];
			$found = false;
			if ($row != null) {
				$count = count($row['books']);
				for ($i = 0; $i < $count; $i++) {
					if ($row['books'][$i]['bk_id'] == $book_id) {
						$this->mBookShelf[$shelf_id]['books'][$i]['ch_id'] = $ch_id;
						$found = true;
						break;
					}
				}
			}
			if ($found) {
				$row['books'] = json_encode($this->mBookShelf[$shelf_id]['books']);
				$row['book_amount']++;
				M('zl_bookshelf_0'.($this->mUserId % 10))->data($row)
					->where('user_id='.$this->mUserId.' and bookshelf_id='.$shelf_id)
					->save();
			}
		}
	}

	public function removeBook($book_id) 
	{
		$shelf_id = $this->mBooks[$book_id];
		if ($shelf_id == null || $this->mBookShelf[$shelf_id] == null)
			return false;
		$size  = count($this->mBookShelf[$shelf_id]['books']);
		$found = false;
		
		$count = count($this->mBookShelf[$shelf_id]['books']);
		for ($i = 0; $i < $count; $i++) {
			if ($this->mBookShelf[$shelf_id]['books'][$i]['bk_id'] == $book_id) {
				array_splice($this->mBookShelf[$shelf_id]['books'], $i, 1);
				$this->mBookShelf[$shelf_id]['book_amount'] --;
				$this->mBooks[$book_id] = null;
				$found = true;
				break;
			}
		}
		if ($found) {
			$row = $this->mBookShelf[$shelf_id];
			$row['books'] = json_encode($this->mBookShelf[$shelf_id]['books']);
			// M('zl_bookshelf_0'.($this->mUserId % 10))->add($row, array(), true);
			M('zl_bookshelf_0'.($this->mUserId % 10))->data($row)
				->where('user_id='.$this->mUserId.' and bookshelf_id='.$shelf_id)
				->save();
		}
	}
}
