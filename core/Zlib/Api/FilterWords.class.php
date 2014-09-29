<?php
/**
 * 作品分类
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;

class FilterWords {
	public $mFilterWords = null;
	private static $mInstance =  null;
	
	public static $mKeyName = "GLOAL##FILERWORDS";
	public static $mLockPrefix = "LOCK##";
	public static $mDirtyPrefix = "DIRTY##";

	// php单例需要把造函数封装起来
	private function __construct(){}

	// 未来考虑从memcache中读取
	public static function getInstance() 
	{
		if (!isset(self::$mInstance)) {
			self::$mInstance =  new FilterWords();
			$mRetry = 3;
			while ($mRetry -- > 0) {
				$succ = self::$mInstance->loadFromCache();
				if (!$succ) {	
					$succ = self::$mInstance->loadFromDatabase();
				}
				if (!$succ) sleep(1); else break;
			}
		}
		return self::$mInstance;
	}

	private function loadFromCache() 
	{
		if ($this->isDirty()) { 
			// echo "dirty";
			 return false; 
		}

		$str = S($this->mKeyName);
		if (!$str) {
			// echo "memcache is null".$this->mKeyName;
			return false;
		}
		
		$this->mFilterWords = json_decode($str, true);	
		if ($this->mFilterWords == null || $this->mFilterWords == false) {
			return false;
		}
		return true;
	}
	
	private function loadFromDatabase() 
	{	
		if (S(self::$mLockPrefix.self::$mKeyName) == "1") {// 加载锁定
			return false;
		}
		$this->mBookClassses = array();
		$m = M("zl_book_flter_word")->where("status=1")->order("classtype asc")->select();
		foreach ($m as $row) {
			array_push($this->mFilterWords, $row);
		}
		S($this->mKeyName, json_encode($this->mBookClasses));
		if ($this->isDirty()) $this->setDirty(false);
		S(self::$mLockPrefix.self::$mKeyName, null);
			
		return true;
	}

	// 返回-1 致命关键词, 禁止录入或者转编辑审核
	// 返回0 没有关键词, 正常
	// 返回n 替换普通关键词数量 
	// 分为0, 1, 2 3级
	public function filter($text) 
	{
		$count = count($this->mFilterWords);
		$reg_array = array();
		$str_array = array();
		for ($i = 0; $i < $count; $i++) {
			if ($this->mFilterWords[$i]['classtype'] == 0) {
				if($this->isFilter($text, $this->mFilterWords[$i]['is_reg']))
					return -1;
		}
	
		$found  = 0;
		for ($i = 0; $i < $count; $i++) {
			if ($this->mFilterWords[$i]['classtype'] == 1) 
				$found += $this->replaceFilter($text, $this->mFilterWords[$i]['is_reg']);
					
			if (C('FILTER.filter_scale') == 2 && $this->mFilterWords[$i]['classtype'] == 2) 
				$found += $this->replaceFilter($text, $this->mFilterWords[$i]['is_reg']);
		}
		return $found;
	}

	public function isFilter($text, $filter, $reg) 
	{
		if ($reg == 1) {
			return preg_match($filter, $text);	
		} else {
			return strstr($text, $filter);
		}
	}

	// 替换,
	public function replaceFilter($text, $filter, $reg) 
	{
		if ($reg == 1) {
		} else {
			return str_replace($text, $filter);
		}
		
	}

	public static function setDirty($dirty = true) 
	{
		if ($dirty) {
			S(self::$mDirtyPrefix.self::$mKeyName, "1");
			S(self::$mLockPrefix.self::$mKeyName, null);
		} else
			S(self::$mDirtyPrefix.self::$mKeyName, null);
	}

	public static function isDirty() {
		return S(self::$mDirtyPrefix.self::$mKeyName) == "1";
	}
	

}
