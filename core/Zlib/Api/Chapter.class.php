<?php
/**
 * 公共的作者api接口
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;
use Zlib\Model\BaseModel;

class Chapter extends BaseModel {

	private $_book_id = Null;
	private $_ch_id = Null;
	private $_chapter_obj = Null;
	
	public function __construct($book_id, $ch_id, $connection = Null)
	{
		parent::__construct();

		$mVolume = array();
		$m= M('zl_book_volume')->where(' volume_status = 1 and bk_id = '.$book_id)->order('volume asc')->select();
		foreach ($m as $row) {
			$mVolume[$row['volume_order']] = $row;
		}

		$this->_book_id = $book_id;
		$this->_ch_id = $ch_id;
		// 创建model对象
		$this->_chapter_obj = $this->getChapterObj();
	}
	
	private function isVip($chapter_id) 
	{
		return false;
	}

	/**
	 * 通过book_id获取章节表
	 *
	 * @param int $book_id
	 * @return String 章节表
	 */
	static public function getName($book_id)
	{
		return 'zl_book_chapter_' . sprintf('%02d', $book_id / 30000);
	}

	/**
	 * 获取vip表名
	 */
	static public function getVipName($ch_id)
	{
		return 'zl_chapter_vip_' . sprintf('%02d', $ch_id % 10);
	}

	/**
	 * 获取章节对象
	 */
	public function getChapterObj()
	{
		return M(self::getName($this->_book_id));
	}

	/**
	 * 获取vip章节对象
	 */
	public function getChapterVipObj()
	{
		return M(self::getVipName($this->_ch_id));
	}

	/**
	 * 获取章节详情
	 */
	public function getChapterInfo()
	{
		return $this->_chapter_obj->where('bk_id = '.$this->_book_id.' and ch_id = '.$this->_ch_id)->find();
	}

	/**
	 * 判断章节是否存在
	 */
	public function checkChapter()
	{
		$result = $this->_chapter_obj->field('ch_id')
				  ->where('bk_id = '.$this->_book_id.' and ch_id = '.$this->_ch_id)->find();
		return empty($result) ? False : True;
	}

	/**
	 * 获取vip章节信息
	 */
	public function getVipChapterInfo()
	{
		$vip_obj = $this->getChapterVipObj();
		return $vip_obj->where('bk_id = '.$this->_book_id.' and ch_id = '.$this->_ch_id)->find();
	}
}
