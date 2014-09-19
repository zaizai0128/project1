<?php
/**
 * 章节阅读controller
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;
use Zlib\Api as Zapi;

class ReadController extends HomeController {

	protected $chapter_api = Null;
	protected $chapter_info = Null;
	protected $is_vip = False; 	// 判断章节是否是vip
	protected $isBuy = False;	// 判断是否已经购买

	public function __construct()
	{
		parent::__construct();
		$this->_checkChapterAcl();
	}

	/**
	 * 普通作品的章节页
	 */
	public function index()
	{
		// 如果是vip,则获取vip内容
		if ($this->is_vip)
			$this->_getVipChapterContent();
		else
			$this->_getChapterContent();

		// 获取相邻章节
		$sibling_chapter = $this->chapter_api->getSiblingChapter();

		$this->assign(array(
			'book_info' => $this->book_info,
			'chapter_info' => $this->chapter_info,
			'sibling_chapter' => $sibling_chapter,
		));
		$this->display();
	}

	/**
	 * 获取普通章节内容
	 */
	private function _getChapterContent()
	{
		// 获取普通章节内容
		$chapter_content = $this->chapter_api->getChapterContent();
		$this->chapter_info = array_merge($this->chapter_info, (array)$chapter_content);
	}

	/**
	 * 获取vip章节内容
	 */
	private function _getVipChapterContent()
	{
		// 获取vip章节内容
		$vip_chapter_info = $this->chapter_api->getVipChapterInfo();
		$this->chapter_info = array_merge($this->chapter_info, (array)$vip_chapter_info);
	}

	/**
	 * 验证章节
	 */
	private function _checkChapterAcl()
	{
		if (empty($this->ch_id)) 
			$this->error('章节不存在');

		// 创建chapter_api对象
		$this->chapter_api = new Zapi\Chapter($this->book_id, $this->ch_id);

		if (!$this->chapter_api->checkChapter())
			$this->error('章节不存在');

		$this->chapter_info = $this->chapter_api->getChapterInfo();

		if ($this->chapter_info['ch_lock'] == 1) {
			$this->error('该章节正处于修正中');
		}

		if ($this->chapter_info['ch_status'] != 0) {
			$this->error('该章节非对外开放');
		}

		// 如果是vip章节，则继续验证
		if ($this->chapter_info['ch_vip'] == 1)
			$this->_checkVipChapterAcl();

		return True;
	}

	/**
	 * 验证vip章节信息
	 */
	private function _checkVipChapterAcl()
	{
		$this->is_vip = True;

		// 验证用户是否登录
		if (!ZS('S.user', '?')) {
			$this->error('请先登录', ZU('login/index'));
		}

		// 验证用户是否已购买该章节
		$vip = new Zapi\UserVipBuy(ZS('S.user', 'user_id'), $this->book_id);
		$is_buy = $vip->isBuyByOrder($this->chapter_info['ch_order']);

		if (!$is_buy) {
			$this->error('请先购买该章节', ZU('buy/index/chapter', 'ZL_DOMAIN', 
						array('book_id'=>$this->book_id, 'ch_id'=>$this->ch_id)));
		}
		$this->isBuy = $is_buy;
		
		return True;
	}
}