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
		$this->_book_id = $book_id;
	}

	/**
	 * 获取作品目录
	 */
	public function getCatalog()
	{
		$catalog = array();
		$cached_chapter = new CachedChapter($this->_book_id);
		$volume = $cached_chapter->getVolumes();
		
		foreach ($volume as $volume_id => $volume_name) {
			$catalog[$volume_id]['volume_id'] = $volume_id;
			$catalog[$volume_id]['volume_name'] = $volume_name;
			$vol = $cached_chapter->getVolumeChapters($volume_id);

			foreach ($vol as $chapter_id => &$chapter_name) {
				$tmp['chapter_name'] = $chapter_name;
				$tmp['chapter_vip'] = $cached_chapter->isVip($chapter_id);
				$tmp['chapter_size'] = $cached_chapter->getSize($chapter_id);
				$tmp['chapter_price'] = z_word_to_money($cached_chapter->getSize($chapter_id));
				$chapter_name = $tmp;
			}
			$catalog[$volume_id]['volume_chapter'] = $vol;
		}
		return $catalog;
	}
	
	/**
	 * 获取book信息
	 */
	public function getBookInfo()
	{
		$book_info = $this->where('bk_id = '.$this->_book_id)->find();
		return $book_info;
	}

	/**
	 * 判断book存不存在
	 */
	public function checkBook()
	{
		$book_info = $this->field('bk_id')->where('bk_id = '.$this->_book_id)->find();
		return empty($book_info) ? False : True ;
	}

	/**
	 * 获取book的全部rank属性
	 */
	public function getAllRank()
	{
		return M('zl_book_rank')->where('bk_id = '.$this->_book_id)->find();
	}
}