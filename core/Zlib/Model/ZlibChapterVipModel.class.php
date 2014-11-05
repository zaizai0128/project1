<?php
/**
 * vip章节 	zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibChapterVipModel extends BaseModel {

	protected $bookId = Null;
	protected $chapterId = Null;
	protected $instance = Null;

	/**
	 * 获取ChapterVip的model对象
	 */
	public function getInstance($book_id, $chapter_id)
	{
		$this->bookId = $book_id;
		$this->chapterId = $chapter_id;
		$this->instance = M($this->getTableName());
		return $this;
	}

	/**
	 * 获取vip内容
	 *
	 * @return string 
	 */
	public function getChapterContent()
	{
		$condition = 'bk_id = '.$this->bookId.' and ch_id = '.$this->chapterId;
		$content = $this->instance->field('ch_content')->where($condition)->find();
		return empty($content) ? '' : $content['ch_content'];
	}

	/**
	 * 设置vip内容
	 */
	public function setChapterContent($content)
	{
		$where['bk_id'] = $this->bookId;
		$where['ch_id'] = $this->bookId;
		$data['ch_content'] = $content;
		return $this->instance->where($where)->data($data)->save();
	}

	/**
	 * 获取vip描述
	 */
	public function getChapterIntro()
	{
		$content = $this->getChapterContent();
		return z_cut_str($content, C('CHAPTER.intro_num'));
	}

	/**
	 * 获取vip信息
	 */
	public function getChapterInfo($field = '*')
	{
		$condition = 'bk_id = '.$this->bookId.' and ch_id = '.$this->chapterId;
		return $this->instance->field($field)->where($condition)->find();
	}

	/**
	 * 获取vip商品章节信息
	 */
	public function getVipCommodityInfo()
	{
		$chapter_instance = new ZlibChapterModel;
		$chapter_instance = $chapter_instance->getInstance($this->bookId, $this->chapterId);

		// 获取vip基础信息
		$chapter_info = $chapter_instance->getChapterInfo();

		// 通过book_id 获取该书的价格配置信息
		$config = M('zl_settle_config')->field('bk_sale')->where('bk_id='.$chapter_info['bk_id'])->find();

		// 计算章节的价格
		$chapter_info['ch_price'] = z_word_to_money($chapter_info['ch_size'], $config['bk_sale']);
		$chapter_info['ch_intro'] = $this->getChapterIntro();
		return $chapter_info;
	}

	/**
	 * 创建
	 */
	public function doAdd($data)
	{
		return $this->instance->data($data)->add();
	}

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id = '.$data['ch_id'];
		return $this->instance->where($condition)->data($data)->save();
	}

	/**
	 * 删除
	 */
	public function doDelete($data)
	{
		$condition = 'bk_id = '.$data['bk_id'].' and ch_id = '.$data['ch_id'];
		return $this->instance->where($condition)->delete();
	}

	/**
	 * 获取vip章节表名
	 */
	public function getTableName()
	{
		return 'zl_chapter_vip_' . sprintf('%02d', $this->chapterId % 10);
	}	
}