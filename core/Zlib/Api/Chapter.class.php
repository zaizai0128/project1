<?php
/**
 * 章节api
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
	
	public function __construct($book_id, $ch_id)
	{
		parent::__construct();

		$this->_book_id = $book_id;
		$this->_ch_id = $ch_id;

		// 创建章节model对象
		$this->_chapter_obj = $this->getChapterObj();
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
	 * 通过章节id % 10
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
	 * 获取章节内容详情
	 */
	public function getChapterContent()
	{
		$chapter_read = C('CH.read') . '/'.$this->_book_id.'/'.$this->_ch_id;
		$content = file_get_contents($chapter_read);
		// 获取头4位编码, 用来判断获取状态
		$status = substr($content, 0, 3);
		// 如果前3位不为000 ，则返回False
		if ($status != '000')
			return False;
		
		// 返回内容
		return array('ch_content'=>substr($content, 4));
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

	/**
	 * 获取vip商品章节信息
	 */
	public function getVipChapterCommodityInfo()
	{
		// 获取vip基础信息
		$chapter_info = $this->_chapter_obj
						->where('bk_id = '.$this->_book_id.' and ch_id = '.$this->_ch_id.' and ch_vip = 1')
						->find();
		// 计算章节的价格
		$chapter_info['ch_price'] = z_word_to_money($chapter_info['ch_size']);

		// 获取vip内容信息
		$vip_obj = $this->getChapterVipObj();
		$chapter_content_info = $vip_obj->where('bk_id = '.$this->_book_id.' and ch_id = '.$this->_ch_id)
								->find();
		$chapter_info = array_merge($chapter_info, (array)$chapter_content_info);
		$chapter_info['ch_intro'] = \Org\Util\String::msubstr($chapter_info['ch_content'], 0, 100);
		
		return $chapter_info;
	}
}