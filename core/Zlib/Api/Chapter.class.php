<?php
/**
 * 公共的作者api接口
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class Chapter extends Zmodel\BaseModel {
	
	public function __construct($bookid, $chapid, $connection)
	{
		$mVolume = array();
		$m= M('zl_book_volume')->where(' volume_status = 1 and bk_id = '.$bookid)->order('volume asc')->select();
		foreach ($m as $row) {
			$mVolume[$row['volume_order']] = $row;
		}
	}
	
	private function isVip($chapter_id) 
	{
		return false;
	}

	public function getName(chapter_id) 
	{
		return name;
	}

	/**
	 * 通过book_id获取章节表
	 *
	 * @param int $book_id
	 */
	public function getTableName($book_id)
	{
		
	}

}
