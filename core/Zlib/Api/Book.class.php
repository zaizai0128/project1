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
	private $mBookId = Null;
	private $mBookInfo = null;

	private $mStateFlushTime = null; 

	private static $mKeyName = "BOOK##";
	private static $mLockPrefix = "LOCK##";
	private static $mDirtyPrefix = "DIRTY##";

	public function __construct($book_id, $load_state = false, $row = null)
	{
		$this->mBookId = $book_id;
		$mRetry = 3;
		// self::setDirty(true, $book_id);
		if ($row != null) {
			$this->setBookInfo($row);
			if ($this->isDirty($this->mBookId)) $this->setDirty(false, $this->mBookId);
		} else {
			while ($mRetry -- > 0) {
				$succ = $this->loadFromCache();
				if (!$succ) {	
					$succ = $this->loadFromDatabase();
				}
				if (!$succ) sleep(1); else break;
			}
		}
		if ($load_state)
			$this->loadState();
	}

	private function loadFromCache() 
	{
		if ($this->isDirty($this->mBookId)) { 
			 return false; 
		}
		$str = S(self::$mKeyName.$this->mBookId);
		if ($str == null && $str == false) 
			return false;
		// echo "loadFromCache(): ";
		$this->mBookInfo = json_decode($str, true);
		return true;
	}
	
	private function loadFromDatabase() 
	{	
		if (S(self::$mLockPrefix.self::$mKeyName.$this->mBookId) == "1") {// 加载锁定
			return false;
		}
		S(self::$mLockPrefix.self::$mKeyName.$this->mBookId, "1");
		// echo "loadFromDatabase()";
		$m = M('zl_book')->where(' bk_status = \'00\' and bk_id = '.$this->mBookId)->select();
		foreach ($m as $row) {
			$this->setBookInfo($row);
			break;
		}
		
		if ($this->isDirty($this->mBookId)) $this->setDirty(false, $this->mBookId);
		S(self::$mLockPrefix.self::$mKeyName.$this->mBookId, null);
		if ($this->mBookInfo == null)
			return false;
		return true;
	}

	public function setBookInfo($row) {
		if ($this->mBookInfo == null)	
			$this->mBookInfo = array();
	
		foreach ($row as $key => $value) {
			if ($key == 'bk_author_com_html')
				continue;
			if ($key == 'bk_intro') {
				if (strlen($value > 300))
					$this->mBookInfo[$key] = z_cut_str($value, 100);
			}
			$this->mBookInfo[$key] = $value;
		}
		
		S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo), 3600 * 6);
	}

	private function loadState() 
	{	

		if ($this->mBookInfo['bk_state_loadtime'] == null || $this->mBookInfo['bk_state_loadtime'] == false) { 
			$m = M('zl_book_rank')->where('bk_id = '.$this->mBookId)->select();
			foreach ($m as $row) {	
				foreach ($row as $key => $value)
					$this->mBookInfo[$key] = $value;
				$this->mBookInfo['bk_state_loadtime'] = time();
				S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo), 3600 * 6);
				
				break;
		
			}
		} else {	
			$this->clearState();
		}
	}
	
	private function clearState() 
	{ 
		$ftime = localtime($this->mBookInfo['bk_state_loadtime'], true);
		$ntime = localtime(time(), true);
		if ($ntime['tm_mday'] != $ntime['tm_mday'])  {
			$this->mBookInfo['bk_visit_day'] = 0;
			if ($ntime['tm_wday'] == 0)  {
				$this->mBookInfo['bk_visit_week'] = 0;
				$this->mBookInfo['bk_collection_week'] = 0;
				$this->mBookInfo['bk_com_week'] = 0;
			}
			if ($ntime['tm_mday'] == 0)  {
				$this->mBookInfo['bk_visit_month'] = 0;
				$this->mBookInfo['bk_com_month'] = 0;
				$this->mBookInfo['bk_collection_month'] = 0;
				$this->mBookInfo['bk_flower_month'] = 0;
			}
			$this->mBookInfo['bk_state_loadtime'] = time();

			S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo), 3600 * 6);
		}
	}

	public function addFlower() 
	{
		//关键数据实时写库: 
		$this->mBookInfo['bk_flower_total']++;
		$this->mBookInfo['bk_flower_month']++;
		
		S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo), 3600 * 6);
		$m = M('zl_book_rank');
		$data = array ('bk_flower_total' => $this->mBookInfo['bk_flower_total'],
				'bk_flower_month' =>   $this->mBookInfo['bk_flower_month']);
		$m->whrere('bk_id='.$mBookId).setField($data);
		
	}
	
	public function addVisit() 
	{
		//关键数据实时写库: 
		$this->mBookInfo['bk_visit_day'] = $this->mBookInfo['bk_visit_day'] + 1;
		$this->mBookInfo['bk_visit_week'] = $this->mBookInfo['bk_visit_week'] + 1;
		$this->mBookInfo['bk_visit_month'] = $this->mBookInfo['bk_visit_month'] + 1;
		$this->mBookInfo['bk_visit_all'] = $this->mBookInfo['bk_visit_all'] + 1;
			
	//	S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo));
		S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo), 3600 * 6);
	}
	
	public function addCom() 
	{
		//关键数据实时写库: 
		$this->mBookInfo['bk_com_week']++;
		$this->mBookInfo['bk_com_month']++;
		$this->mBookInfo['bk_com_all']++;
		
		S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo), 3600 * 6);
	}
	
	public function addCollection() 
	{
		//关键数据实时写库: 
		$this->mBookInfo['bk_collection_week']++;
		$this->mBookInfo['bk_collection_month']++;
		$this->mBookInfo['bk_collection_all']++;
		
		S(self::$mKeyName.$this->mBookId, json_encode($this->mBookInfo), 3600 * 6);
	}	

	public function getInfo($load_state = false) 
	{
		if ($load_state)
			$this->loadState();
		return $this->mBookInfo;
	}

	/**
	 * 获取作品目录
	 */
	public static function getCatalog($book_id, $user_id = Null, $all = False)
	{
		$catalog = array();
		$cached_chapter = new CachedChapter($book_id);
		$vip = new UserVipBuy($user_id, $book_id, $cached_chapter);
		$volume = $cached_chapter->getVolumes();

		foreach ($volume as $volume_id => $volume_name) {
			$catalog[$volume_id]['volume_id'] = $volume_id;
			$catalog[$volume_id]['volume_name'] = $volume_name;
			$vol = $cached_chapter->getVolumeChapters($volume_id, $all);

			foreach ($vol as $chapter_id => &$chapter_name) {
				$tmp['chapter_name'] = $chapter_name;
				$tmp['chapter_vip'] = $cached_chapter->isVip($chapter_id);
				$tmp['chapter_size'] = $cached_chapter->getSize($chapter_id);
				$tmp['chapter_status'] = $cached_chapter->getStatus($chapter_id);
				$tmp['chapter_price'] = z_word_to_money($cached_chapter->getSize($chapter_id));
				
				if ($tmp['chapter_vip']) {
					$tmp['chapter_own'] = $vip->isBuyByOrder($cached_chapter->getChapterOrder($chapter_id));
				}

				$tmp['chapter_order'] = $cached_chapter->getChapterOrder($chapter_id);
				$chapter_name = $tmp;
			}
			$catalog[$volume_id]['volume_chapter'] = $vol;
		}
		return $catalog;
	}

	/**
	 * 获取作品封面
	 *
	 * @param int book_id
	 * @param int cover 是否有封面
	 * @param int site  站点
	 */
	public static function getCover($book_id = Null, $cover = 1, $site = 0)
	{
		// 如果作品不存在，则返回默认图片
		if (empty($book_id) || $cover != 1)
			return C('ZL_IMAGE_DOMAIN') . '/www/image/no_book.gif' . '?' . time();
		
		$domain = $site == 0 ? C('ZL_IMAGE_DOMAIN') : C('ZL_NV_IMAGE_DOMAIN') ;

		// 为方便本地测试，修改一下规则
		if ($book_id > 303730) {
			// 本地测试的作品，改为测试域名
			$domain = 'http://images.zhulang.ne';
		}

		$img = floor( $book_id / 10000 )."/".floor( $book_id % 10000 / 100 )."/".$book_id.".jpg";
		$img_url = $domain . '/book_cover/image/' . $img;

		if ($fr = @fopen($img_url, 'r')) {
			fclose($fr);
			return $img_url;
		} else {
			fclose($fr);
			return C('ZL_IMAGE_DOMAIN') . '/www/image/no_book.gif' . '?' . time();
		}
	}

	/**
	 * 上传作品封面
	 * @return string 封面的地址
	 */
	public static function uploadCover($book_id, $site = 0)
	{		
		if (empty($_FILES['cover']['name'])) return;
		$upload = new \Think\Upload();
		$upload->maxSize = C('BOOK.upload_max');	// 设置允许上传的最大尺寸
		$upload->subName = False;
		$upload->saveName = False;
		$upload->replace = True;
		$upload->hash = False;

		$domain = $site == 0 ? C('ZL_IMAGE_DOMAIN') : C('ZL_NV_IMAGE_DOMAIN') ;
		// 为方便本地测试，修改一下规则
		if ($book_id > 303730) {
			// 本地测试的作品，改为测试域名
			$domain = 'http://images.zhulang.ne';
		}

		$save_path = '/'.floor( $book_id / 10000 )."/".floor( $book_id % 10000 / 100 )."/";

		$upload->rootPath = C('ZL_BOOK_COVER_PATH');
		$upload->savePath = $save_path;
		$upload->saveName = $book_id;
		$upload->saveExt = 'jpg';

		$info = $upload->uploadOne($_FILES['cover']);

		if ($info) {
			$cover = $domain . '/book_cover/image' . $info['savepath'] . $info['savename'];
			return z_info(1, $cover);
		 } else {
			return z_info(-1, $upload->getError());
		}
	}

	public static function isCached($book_id) {
		return !(S(self::$mKeyName.$book_id) == false);
	}

	public static function setDirty($dirty, $book_id) 
	{	
		if ($dirty) {
			S(self::$mDirtyPrefix.self::$mKeyName.$book_id, "1");
			S(self::$mLockPrefix.self::$mKeyName.$book_id, null);
			CachedChapter::setDirty($dirty, $book_id);
		} else
			S(self::$mDirtyPrefix.self::$mKeyName.$book_id, null);
	}

	public static function isDirty($book_id) {
		return S(self::$mDirtyPrefix.self::$mKeyName.$book_id) == "1";
	}
}
