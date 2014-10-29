<?php
/**
 * 作品分类
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;

class BookBan {
	public $mBookBan0 = null;
	public $mBookBan1 = null;
	public $mBookBan2 = null;
	private static $mInstance =  null;

	public static $mKeyName = "GLOAL##BOOKBAN";
	public static $mLockPrefix = "LOCK##";
	public static $mDirtyPrefix = "DIRTY##";

	// php单例需要把造函数封装起来
	private function __construct(){}

	// 未来考虑从memcache中读取
	public static function getInstance() 
	{
		if (!isset(self::$mInstance)) {
			self::$mInstance =  new BookBan();
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

		$loaded = false;
		$str = S($this->mKeyName."#0");
		if ($str !=  null && !$str) {
			$this->mBookBan0 = json_decode($str, true);	
			$loaded = true;
		}
		$str = S($this->mKeyName."#1");
		if ($str !=  null && !$str) {
			$this->mBookBan1 = json_decode($str, true);	
			$loaded = true;
		}

		$str = S($this->mKeyName."#1");
		if ($str !=  null && !$str) {
			$this->mBookBan1 = json_decode($str, true);	
			$loaded = true;
		}
		if (!$loaded)
			return false;
		if ($this->mBookBan0 == null) 
			$this->mBookBan0 = array();
		if ($this->mBookBan1 == null) 
			$this->mBookBan2 = array();
		if ($this->mBookBan2 == null) 
			$this->mBookBan2 = array();
		return true;
	}

	private function loadFromDatabase() 
	{	
		// echo "loadFromDababase();";
		if (S(self::$mLockPrefix.self::$mKeyName) == "1") {// 加载锁定
			// echo "locked";
			return false;
		}
		$this->mBookBan0 = array();
		$this->mBookBan1 = array();
		$this->mBookBan2 = array();

		// $m = M("zl_book_banlist")->where("status=1 and ban_end > now()")->order("insert_time asc")->select();
		$m = M("zl_book_banlist")->where("status=1 and ban_end > now()")->select();
		foreach ($m as $row) {
			$temp = array();
			$temp['ban_start'] = $row['ban_start'];
			$temp['ban_end'] = $row['ban_end'];
			switch ($row['ban_type']) {
				case 0:
					self::$mInstance->mBookBan0[$row['bk_id']] = $temp;
					break;
				case 1:
					self::$mInstance->mBookBan1[$row['bk_id']] = $temp;
					break;
				case 2:
					self::$mInstance->mBookBan2[$row['bk_id']] = $temp;
					break;
			}
		}
		S($this->mKeyName."#0", json_encode($this->mBookBan0));
		S($this->mKeyName."#1", json_encode($this->mBookBan1));
		S($this->mKeyName."#2", json_encode($this->mBookBan2));
		if ($this->isDirty()) $this->setDirty(false);
		S(self::$mLockPrefix.self::$mKeyName, null);

		return true;
	}

	public function isBan($book_id) 
	{
		$row = $this->mBookBan0[$book_id];
		if ($row == null || !$row)
			return false;
		$now = date('Y-m-d H:i:s');
		if (strcmp($now, $row['ban_start']) < 0 || strcmp($now, $row['ban_end']) > 0)
			return false;
		return true;
	}

	public function isBanOnTop($book_id) 
	{
		if ($this->isBaned($book_id))
			return true;
		$row = $this->mBookBan1[$book_id];
		if ($row == null || !$row)
			return false;
		$now = date('Y-m-d H:i:s');
		if (strcmp($now, $row['ban_start']) < 0 || strcmp($now, $row['ban_end']) > 0)
			return false;
		return true;
	}	

	public function isBanOnUpdate($book_id) 
	{
		if ($this->isBaned($book_id))
			return true;
		$row = $this->mBookBan2[$book_id];
		if ($row == null || !$row)
			return false;
		$now = date('Y-m-d H:i:s');
		if (strcmp($now, $row['ban_start']) < 0 || strcmp($now, $row['ban_end']) > 0)
			return false;
		return true;
	}

	public function addBanList($book_list) 
	{	
		$count = count($book_list);
		$now = date('Y-m-d H:i:s');
		$m = M('zl_book_banlist');
		for ($i = 0; $i < $count; $i++) {
			$row = null;
			$bk_id = $book_list[$i]['bk_id'];
			switch ($book_list[$i]['ban_type']) {
				case 0:	
					$row = $this->mBookBan0[$bk_id];	
					break;
				case 1:
					$row = $this->mBookBan1[$bk_id];	
					break;
				case 2:
					$row = $this->mBookBan2[$bk_id];	
					break;
			}
			if ($row != null && $row != false) {
				// print "start";
				$ban_start = $book_list[$i]['ban_start'];
				$ban_end = $book_list[$i]['ban_end'];
				if ($ban_start == null || $ban_start == false)	
					$ban_start = '0000-00-00 00:00:00';
				if ($ban_end == null || $ban_end == false)	
					$ban_end = '2099-12-31 23:59:59';
				// print_r($row);
				// print "|||".$ban_start."|||";

				if (strcmp($row['ban_start'], $ban_start) ==0 && strcmp($row['ban_end'], $ban_end) ==0)
					continue;
				$ban_type = $book_list[$i]['ban_type'];
				$data = array();
				$data['status'] = '0';
				$data['disable_time'] = $now;
				// echo 'bk_id=\''.$bk_id.'\' and ban_type=\''. $ban_type.' and disable_time=\'0000-00-00 00:00:00\'';
				$m->data($data)->where('bk_id=\''.$bk_id.'\' and ban_type='.
						$ban_type.' and disable_time=\'0000-00-00 00:00:00\'')->save(); 
			}
			$data = $book_list[$i];
			$data['insert_time'] = $now;
			$m->add($data, array());
		}
		$this->setDirty(true);
	}

	public function removeBanList($book_list) 
	{	
		$count = count($book_list);
		$m = M('zl_book_banlist');
		for ($i = 0; $i < $count; $i++) {
			$row = null;
			$bk_id = $book_list[$i];
			$ban_type = 0;
			$row = $this->mBookBan0[$bk_id];	
			if ($row != null && $row) {
				$ban_type = $book_list[$i]['ban_type'];
				$data = array();
				$data['status'] = '0';
				$data['disable_time'] = date('Y-m-d H:i:s');
				$m->data($data)->where('bk_id=\''.$bk_id.'\' and ban_type=\''.
						$ban_type.' and disable_time=\'0000-00-00 00:00:00')->save(); 
			}
		}
		$this->setDirty(true);
	}

	public function removeBanTopList($book_list) 
	{	
		$count = count($book_list);
		$m = M('zl_book_banlist');
		for ($i = 0; $i < $count; $i++) {
			$row = null;
			$bk_id = $book_list[$i];
			$ban_type = 1;
			$row = $this->mBookBan1[$bk_id];	
			if ($row != null && $row) {
				$ban_type = $book_list[$i]['ban_type'];
				$data = array();
				$data['status'] = '0';
				$data['disable_time'] = date('Y-m-d H:i:s');
				$m->data($data)->where('bk_id=\''.$bk_id.'\' and ban_type=\''.
						$ban_type.' and disable_time=\'0000-00-00 00:00:00')->save(); 
			}
		}
		$this->setDirty(true);
	}

	public function removeBanUpdateList($book_list) 
	{	
		$count = count($book_list);
		$m = M('zl_book_banlist');
		for ($i = 0; $i < $count; $i++) {
			$row = null;
			$bk_id = $book_list[$i];
			$ban_type = 2;
			$row = $this->mBookBan2[$bk_id];	
			if ($row != null && $row) {
				$ban_type = $book_list[$i]['ban_type'];
				$data = array();
				$data['status'] = '0';
				$data['disable_time'] = date('Y-m-d H:i:s');
				$m->data($data)->where('bk_id=\''.$bk_id.'\' and ban_type=\''.
						$ban_type.' and disable_time=\'0000-00-00 00:00:00')->save(); 
			}
		}
		$this->setDirty(true);
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
