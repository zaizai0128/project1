<?php
/**
 * 用户视角下的书
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;
use Zlib\Model\BaseModel;

class Book extends BaseModel{

	private $_book_id = Null;
	private $volume = null;
	private $chapter = null;
	protected $trueTableName = 'zl_book';

	public function __construct($book_id)
	{
		parent::__construct();
		// $this->volume = new Volume($bookid);
		// $this->chapter = new Chapter($bookid);
		$this->_book_id = $book_id;
	}
	
	/**
	 * 获取book信息
	 */
	public function getBookInfo()
	{
		$book_info = $this->where('bk_id = '.$this->_book_id.' and bk_status = "00"')->find();
		return $book_info;
	}

	/**
	 * 判断book存不存在
	 */
	public function checkBook()
	{
		$book_info = $this->field('bk_id')->where('bk_id = '.$this->_book_id.' and bk_status = "00"')->find();
		return empty($book_info) ? False : True ;
	}
	
}
