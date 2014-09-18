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
	
	private $mVolume = null;
	private $mChapter = null;
	private $mDirty = true;

	private $mTableInciseSize = 30000;     // 每隔 tableInciseSize 本书拆分一张章节子表 

	private $mVolumeNameIndex = 0;   
	private $mVolumeIntroIndex = 1; 
	private $mVolumeChaptersIndex = 2; 
	
	public function __construct($book_id)
	{	
		$this->mVolume = array();
		$this->mChapter = array();
		if (true) {
			$temp = array();
			array_push($temp, '垃圾箱');
			array_push($temp, '');
			array_push($temp, array());
			$this->mVolume[-10] = $temp;

			$temp1 = array();
			array_push($temp1, '作品相关介绍');
			array_push($temp1, '');
			array_push($temp1, array());
			$this->mVolume[100] = $temp1; 
		}
	
		if ($this->mDirty) {
			$m = M('zl_book_volume')->where(' volume_status = 0 and bk_id = '.$book_id)->order('volume_order asc')->select();
			$vols = 0;	
			foreach ($m as $row) {	
				$temp = array();
				array_push($temp, $row['volume_name']);
				array_push($temp, $row['volume_intro']);
				array_push($temp, array());
				$this->mVolume[$row['volume_order']] = $temp;
				$vols++;
			}
			if ($vols == 0) {
				$temp1 = array();
				array_push($temp1, '正文');
				array_push($temp1, '');
				array_push($temp1, array());
				$this->mVolume[1000] = $temp1;
			}

			$table = $this->getChapterTable($book_id);
			$m = M($table)->where(' ch_status=0 and bk_id = '.$book_id)->order('ch_roll asc, ch_order asc')->select();
			$ch_order = 0;
			foreach ($m as $row) {
				$row['ch_order'] = $ch_order;
				$ch_order ++;
				$this->mChapter[$row['ch_id']] = $row;
				array_push($this->mVolume[$row['ch_roll']][$this->mVolumeChaptersIndex], $row['ch_id']);
			} 
		}
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
				$result[$volume_id] = $volume_array[$this->mVolumeNameIndex];
			}
		}
		return $result;
	}
	
	private function getVolumeIntro($volume_id) 
	{	
		if ($this->mVolume[$volume_id] == null)
			return '';
		return $this->mVolume[$volume_id][$this->mVolumeIntroIndex];
	}

	public function getVolumeChapters($volume_id) 
	{	
		$result = array();
		$arr = localtime(time(), true);
		$now = sprintf("%04d-%02d-%02d %02d:%02d%02d",
			$arr['tm_year'] + 1900,  $arr['tm_mon'] + 1, $arr['tm_mday'], 
			$arr['tm_hour'], $arr['tm_min'], $arr['tm_sec']); 

	 	foreach ($this->mVolume[$volume_id][$this->mVolumeChaptersIndex] as  $chapter_id) {
			// echo "test".$this->mChapter[$chapter_id]['ch_effect_time']."\n";
			if ($this->mChapter['ch_effect_time'] <= $now)
				$result[$chapter_id] = $this->mChapter[$chapter_id]['ch_name'];
		}
		return $result;
	}

	public function getChapters($vip) 
	{	
		$result = array();
		$arr = localtime(time(), true);
		$now = sprintf("%04d-%02d-%02d %02d:%02d%02d",
			$arr['tm_year'] + 1900,  $arr['tm_mon'] + 1, $arr['tm_mday'], 
			$arr['tm_hour'], $arr['tm_min'], $arr['tm_sec']); 

	 	foreach ($this->mChapter as  $chapter) {
			if ($chapter['ch_vip'] == 1 && $vip) {
				$result[$chaper_id] = $this->mVolume[$chapter['ch_roll']][$this->mVolumeNameIndex]
					. ' ' .$this->mChapter['ch_name'];
			}
			if ($chapter['ch_vip'] == 0 && !$vip) {
	//			$result[$chaper_id] = $this->mVolume[$chapter['ch_roll']][$this->mVolumeName] . ' ' .$this->mChapter['ch_name'];
				$result[$chaper_id] = $this->mChapter['ch_name'];
			}
		}
		return $result;
	}
	
	public function isVip($chapter_id) 
	{
		return $this->mChapter[$chapter_id]["ch_vip"] == 1;
	}

	public function getName($chapter_id) 
	{
		return $mChapter[$chapter_id]["ch_name"];
	}

	public function getChapterOrder($chapter_id) 
	{
		return $mChapter[$chapter_id]["ch_order"];
	}
}