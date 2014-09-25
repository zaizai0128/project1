<?php
/**
 * 作品管理
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;

class Book {

	private $_bookId = Null;

	public function __construct($book_id)
	{
		$this->_bookId = $book_id;
	}

	/**
	 * 获取作品目录
	 */
	public function getCatalog($user_id = Null)
	{
		$catalog = array();
		$cached_chapter = new CachedChapter($this->_bookId);
		$vip = new UserVipBuy($user_id, $this->_bookId);
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
				
				if ($tmp['chapter_vip']) {
					$tmp['chapter_own'] = $vip->isBuyByOrder($cached_chapter->getChapterOrder($chapter_id));
				}
				$chapter_name = $tmp;
			}
			$catalog[$volume_id]['volume_chapter'] = $vol;
		}
		return $catalog;
	}
}