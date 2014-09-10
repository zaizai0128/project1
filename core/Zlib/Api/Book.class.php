<?php
/**
 * 用户视角下的书
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class Book extends Model{
	private $volume = null;
	private $chapter = null;
	
	public __construct($book_id)
	{
		$this->volume = new Volume($bookid);
		$this->chapter = new Chapter($bookid);
	}
	

	
}
