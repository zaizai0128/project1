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
	private $mReplaceWord = '*';

	// php单例需要把造函数封装起来
	private function __construct(){}

	// 未来考虑从memcache中读取
	public static function getInstance() 
	{
		if (!isset(self::$mInstance)) {
			self::$mInstance =  new FilterWords();
			self::$mInstance->setDirty(true);
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
		echo "loadFromDatabase::";
		if (S(self::$mLockPrefix.self::$mKeyName) == "1") {// 加载锁定
			return false;
		}
		S(self::$mLockPrefix.self::$mKeyName, "1");
		$this->mFilterWords = array();
		$m = M("zl_book_filter_words")->where("status=1")->order("classtype asc, word desc")->select();
		foreach ($m as $row) {
			if ($row['is_reg'] == '1') $row['word'] = '/'.$row['word'].'/miu'; // 不加u 好像无法匹配中文字
			array_push($this->mFilterWords, $row);
		}
		// print_r($this->mFilterWords);
		S($this->mKeyName, json_encode($this->mBookClasses));
		if ($this->isDirty()) $this->setDirty(false);
		S(self::$mLockPrefix.self::$mKeyName, null);
			
		return true;
	}
	
	// 返回true|false 致命关键词, 禁止录入或者转编辑审核
	public function hasDeadWord($text)
	{ 
		$count = count($this->mFilterWords);
		for ($i = 0; $i < $count; $i++) {
			$word =  $this->mFilterWords[$i]['word'];
			if ($this->mFilterWords[$i]['classtype'] == '1') {
				if ($this->isFilter($text, $word, $this->mFilterWords[$i]['is_reg']) != false)
					return true;
			}
		}
		return false;
	}

	/**
	 * 将错误关键字 替换为 *
	 */
	public function filter($text, $shuping = false) 
	{
		$count = count($this->mFilterWords);
	
		$found  = 0;
		$str_arr = array();
		$reg_arr = array();
		$replace_arr = array();
		
		for ($i = 0; $i < $count; $i++) {
			$word =  $this->mFilterWords[$i]['word'];
			if ($this->mFilterWords[$i]['classtype'] == 3 && !$shuping) 
				$word = null;	

			if ($this->mFilterWords[$i]['classtype'] == 1) 
				$word = null;

			if ($word != null) { 
				if ($this->mFilterWords[$i]['is_reg'] == 0) {	
					array_push($str_arr, $word);
				} else {
					array_push($reg_arr, $word);
					array_push($replace_arr, $this->mReplaceWord);
				}
			} 
		}

		// 将非正则匹配的错误字 替换为*
		if (count($str_arr) > 0) {
			$text = str_replace($str_arr, '*', $text);
		}

		if (count($reg_arr) > 0) {
			print_r($reg_arr);
			$text = preg_replace($reg_arr, $replace_arr, $text);
		}	

		return $text;
	}

	/**
	 * 获取内容中问题词数量，并返回数组
	 */
	public function getFilterWord($text, $shuping = Flase)
	{	
		$word_arr = array();

		// 获取普通过滤词汇
		foreach ($this->mFilterWords as $val) {
			if ($val['classtype'] == 3 && !$shuping || $val['classtype'] == 1)
				continue;

			// 拼接正则匹配
			$word = $val['word'];
			if ($val['is_reg'] == 1) {
				preg_match_all($word, $text, $all);
				$word_arr = array_merge($word_arr, $all[0]);

			// 普通匹配词
			} else {
				$num_total = substr_count($text, $word);
				if ($num_total > 0) {
					$word = array_fill(0, $num_total, $word);
					$word_arr = array_merge($word_arr, $word);
				}
			}	
		}

		return $word_arr;
	}

	private function isFilter($text, $filter, $reg) {
		if ($reg == 1) {
			echo $filter.":".preg_match($filter, $text)."<br>";
			return preg_match($filter, $text) == 1;	
		} else {
			// echo $text." ".$filter;
			return strstr($text, $filter);
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
