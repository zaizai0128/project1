<?php
/**
 * 作品封面页
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-16
 * @version 1.0
 */
namespace Home\Controller;

class BookController extends HomeController {

	protected $bookId = Null;
	protected $bookInfo = Null;
	protected $bookInstance = Null;
	protected $bookApi = Null;

	public function __construct()
	{
		parent::__construct();
		$this->bookId = I('get.book_id');
		$this->bookInstance = D('Book', 'Service');
		$this->bookApi = new \Zlib\Api\Book($this->bookId);

		// 获取作品信息
		$this->bookInfo = $this->bookApi->getInfo();

		// 验证该作品是否允许被访问
		\Zlib\Api\Acl::book($this->bookInfo);
	}

	/**
	 * 封面首页
	 */
	public function index()
	{
		// 其他一些赋值
		$assign = array();	

		// 获取作品分类路径
		$book_cate = \Zlib\Api\BookClass::getInstance()->getPathArray($this->bookInfo['bk_class_id']); 
		// 获取作品类型
		$assign['category'] = $book_cate[substr($this->bookInfo['bk_class_id'], 0, 2)]['name'];
		// 获取点击排名
		$assign['rank'] = $this->bookInstance->getRank($this->bookInfo['bk_id']);	

		// 获取最近更新的普通章节简介
		$chapterInstance = D('Chapter', 'Service')->getInstance($this->bookInfo['bk_id'], $this->bookInfo['bk_public_ch_id']);
		$this->bookInfo['public_ch_intro'] = $chapterInstance->getChapterIntro();

		$this->assign(array(
			'assign' => $assign,
			'book_info' => $this->bookInfo,
			'book_cate' => $book_cate,
		));
		$this->display();
	}
}