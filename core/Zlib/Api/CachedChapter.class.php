<?php
/**
 * 公共的作者api接口
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 * 先实现数据库读取，之后实现memcache加载和更新
 */
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class CachedChapter {

	public $mVolume = null;
	public $mChapter = null;
	private $mDirty = true;

	private $mTableInciseSize = 30000;     // 每隔 tableInciseSize 本书拆分一张章节子表 

	private $mVolumeNameIndex = 0;   
	private $mVolumeIntroIndex = 1; 
	private $mVolumeChaptersIndex = 2; 
	private $mBookId = null; 

	public static $mKeyName = "BOOK##CATALOG##";
	public static $mLockPrefix = "LOCK##";
	public static $mDirtyPrefix = "DIRTY##";


	public function __construct($book_id)
	{	
	
		$this->mBookId = $book_id;
		$mRetry = 3;
		// self::setDirty(true, $book_id);
		while ($mRetry -- > 0) {
			$succ = $this->loadFromCache();
			if (!$succ) {	
				$succ = $this->loadFromDatabase();
			}
			if (!$succ) sleep(1); else break;
		}

	}

	private function loadFromCache() 
	{
		if ($this->isDirty($this->mBookId)) { 
			 return false; 
		}
		$str = S(self::$mKeyName.$this->mBookId."##VOLUME");
		if ($str == null && $str == false)
			return false;	
		$this->mVolume = json_decode($str, true);
		if ($this->mVolume== null && $this->mVlume == false)
			return false;

		$str = S(self::$mKeyName.$this->mBookId."##CHAPTER");
		if ($str != null && $str != false) 
			$this->mChapter = json_decode($str, true);
		if ($this->mChapter == null || $this->mChapter == false)
			$this->mChapter = array();
		return true;
	}
	
	private function loadFromDatabase() 
	{	
		if (S(self::$mLockPrefix.self::$mKeyName.$this->mBookId) == "1") {// 加载锁定
			return false;
		}
		$this->mVolume = array();
		$this->mChapter = array();

		S(self::$mLockPrefix.self::$mKeyName.$this->mBookId, "1");

		// echo "loadFromDababase();";
		if (true) {
			$temp = array();
			array_push($temp, base64_encode('垃圾箱'));
			array_push($temp, '');
			array_push($temp, array());
			$this->mVolume[-10] = $temp;

			$temp1 = array();
			array_push($temp1, base64_encode('作品相关介绍'));
			array_push($temp1, '');
			array_push($temp1, array());
			$this->mVolume[100] = $temp1; 
		}
		$m = M('zl_book_volume')->where(' volume_status = 0 and bk_id = '.$this->mBookId)->order('volume_order asc')->select();
		$vols = 0;	
		foreach ($m as $row) {	
			$temp = array();
			array_push($temp, base64_encode($row['volume_name']));
			array_push($temp, base64_encode($row['volume_intro']));
			array_push($temp, array());
			$this->mVolume[$row['volume_order']] = $temp;
			$vols++;
		}
		if ($vols == 0) {
			$temp1 = array();
			array_push($temp1, base64_encode('正文'));
			array_push($temp1, '');
			array_push($temp1, array());
			$this->mVolume[1000] = $temp1;
		}

		$table = $this->getChapterTable($this->mBookId);
		$m = M($table)->where(' (ch_status=0 or ch_status=2) and bk_id = '.$this->mBookId)->order('ch_roll asc, ch_order asc')->select();
		$ch_order = 0;
		foreach ($m as $row) {
			// $row['ch_order'] = $ch_order;
			// $ch_order ++;	
			$row['ch_name'] = base64_encode($row['ch_name']);
			$this->mChapter[$row['ch_id']] = $row;
			array_push($this->mVolume[$row['ch_roll']][$this->mVolumeChaptersIndex], $row['ch_id']);
		}

		if (count($this->mChapter) > 10) { // 大于10章才放
			S(self::$mKeyName.$this->mBookId."##VOLUME", json_encode($this->mVolume), 3600 * 24);
			S(self::$mKeyName.$this->mBookId."##CHAPTER", json_encode($this->mChapter), 3600 * 24);
		}
		if ($this->isDirty($this->mBookId)) $this->setDirty(false, $this->mBookId);
		S(self::$mLockPrefix.self::$mKeyName.$this->mBookId, null);
		return true;
	}

	

	private function getChapterTable($bookId)
	{
		$indexNum = str_pad(floor($bookId / $this->mTableInciseSize), 2, "0", STR_PAD_LEFT);
		$tableName = "zl_book_chapter_".$indexNum;
		return $tableName;
	}

	public function getVolumes() 
	{	
		$result = array();
		// $result[100] = $this->mVolume[100][$this->mVolumeName];	
		foreach ($this->mVolume as $volume_id => $volume_array) {	
			// if ($volume_id == -10 || $volume_id == 100)
			if ($volume_id == -10)
				continue;

			if (count($volume_array[$this->mVolumeChaptersIndex])) {
				$result[$volume_id] =  base64_decode($volume_array[$this->mVolumeNameIndex]);
			}
		}
		return $result;
	}

	private function getVolumeIntro($volume_id) 
	{	
		if ($this->mVolume[$volume_id] == null)
			return '';
		return base64_decode($this->mVolume[$volume_id][$this->mVolumeIntroIndex]);
	}

	public function getVolumeChapters($volume_id, $editor = false) 
	{	
		$result = array();

		// 下面这个操作 是为了获取 2014-10-01 21:21:21 ?
		// date('Y-m-d H:i:s', time()) 即可获取上面的格式
		$arr = localtime(time(), true);
		$now = sprintf("%04d-%02d-%02d %02d:%02d%02d",
				$arr['tm_year'] + 1900,  $arr['tm_mon'] + 1, $arr['tm_mday'], 
				$arr['tm_hour'], $arr['tm_min'], $arr['tm_sec']); 

		foreach ($this->mVolume[$volume_id][$this->mVolumeChaptersIndex] as  $chapter_id) {
			// echo "test".$this->mChapter[$chapter_id]['ch_effect_time']."\n";
			if ($this->mChapter[$chapter_id]['ch_status'] == 2 && !$editor) {	
				continue;
			}

			// 只有非管理后台，才进行该时间判断
			if ($editor || $this->mChapter[$chapter_id]['ch_effect_time'] <= $now) {
				$result[$chapter_id] = base64_decode($this->mChapter[$chapter_id]['ch_name']);
			}
		}
		return $result;
	}

	public function getChapters($vip, $editor = false) 
	{	
		$result = array();
		$arr = localtime(time(), true);
		$now = sprintf("%04d-%02d-%02d %02d:%02d%02d",
				$arr['tm_year'] + 1900,  $arr['tm_mon'] + 1, $arr['tm_mday'], 
				$arr['tm_hour'], $arr['tm_min'], $arr['tm_sec']); 

		foreach ($this->mChapter as  $chapter) {
			if ($chapter['ch_status'] == 2 && !$editor) {	
				continue;
			}
			if ($chapter['ch_vip'] == 1 && $vip) {
				// $result[$chaper_id] = $this->mVolume[$chapter['ch_roll']][$this->mVolumeNameIndex]
				//	. ' ' .base64_decode($this->mChapter['ch_name']);
				$result[$chaper_id] = base64_decode($this->mChapter['ch_name']);
			}
			if ($chapter['ch_vip'] == 0 && !$vip) {
				//	$result[$chaper_id] = $this->mVolume[$chapter['ch_roll']][$this->mVolumeName] . ' ' .base64_decode($this->mChapter['ch_name']);
				$result[$chaper_id] = base64_decode($this->mChapter['ch_name']);
			}
		}
		return $result;
	}

	public function isVip($chapter_id) 
	{
		return $this->mChapter[$chapter_id]["ch_vip"] == 1;
	}

	public function getSize($chapter_id)
	{
		return $this->mChapter[$chapter_id]['ch_size'];
	}

	public function getStatus($chapter_id)
	{
		return $this->mChapter[$chapter_id]['ch_status'];
	}

	public function getBookId()
	{
		return $this->mBookId;
	}


	public function getName($chapter_id) 
	{
		return base64_decode($this->mChapter[$chapter_id]["ch_name"]);
	}

	public function getChapterOrder($chapter_id) 
	{
		return $this->mChapter[$chapter_id]["ch_order"];
	}

	// 由Book.class.php调用即可
	public static function setDirty($dirty, $book_id) 
	{	
		if ($dirty) {
			S(self::$mDirtyPrefix.self::$mKeyName.$book_id, "1");
			S(self::$mLockPrefix.self::$mKeyName.$book_id, null);
		} else
			S(self::$mDirtyPrefix.self::$mKeyName.$book_id, null);
	}

	public static function isDirty($book_id) {
		return S(self::$mDirtyPrefix.self::$mKeyName.$book_id) == "1";
	}
	
}
