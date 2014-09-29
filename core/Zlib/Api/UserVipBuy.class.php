<?php
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class UserVipBuy {
	private $mChapterBuyBits = null;
	private $mUserId = null;
	private $mBookId = null;
	private $mCachedChapter = null;
	private $mVipMaxOrder = 0;		// 最大vip_order
	private $mVipCount = 0;			// 合集Vip章数， 可以做数据校验
	
	// user登陆之后才去生成
	public function __construct($user_id, $book_id, $cached_chapter = null) 
	{	
		$this->mUserId = $user_id;
		$this->mBookId = $book_id;
		if ($cached_chapter->getBookId() == $this->mBookId)
			$this->mCachedChapter = $cached_chapter;
		
		// 加载数据: 
		$m = M('zl_user_vipbuy')->where('user_id='.$user_id.' and bk_id='.$book_id)->select();
		foreach ($m as $row) {
			$this->mChapterBuyBits = base64_decode($row['vip_chapters']);
			$this->mVipCount = $row['vip_count'];
			$this->mVipMaxOrder= $row['vip_max_order'];
			break;
		}

		if ($this->mChapterBuyBits != null) {
			if ($this->mCachedChapter == null)
				$this->mCachedChapter = new CachedChapter($book_id); 
		}
	}
	
	public function isBuy($chapter_id) 
	{
		if ($this->mChapterBuyBits == null)
			return false;
		$ch_order = $this->mCachedChapter->getChapterOrder($chapter_id);
		return $this->isBuyBuyOrder($ch_order);
	}

	public function isBuyByOrder($ch_order) 
	{
		if ($this->mChapterBuyBits == null)
			return false;
		$byte_count = $ch_order / 8;
		$bit = 1 << ($ch_order % 8);
		$byte = ord($this->mChapterBuyBits[$byte_count]);
		return !(($byte & $bit) == 0);
	}


	public function setBuy($chapter_id) 
	{
		if ($this->mCachedChapter == null) {
			$this->mCachedChapter = new CachedChapter($book_id);
		}
		$ch_order = $this->mCachedChapter->getChapterOrder($chapter_id);
		return $this->setBuyByOrder($ch_order);
	}

	public function setBuyByOrder($ch_order) 
	{	
		if ($this->mChapterBuyBits == null) {
			$byte_count = floor($ch_order / 8 + 1);
			$this->mChapterBuyBits = str_pad(chr(0), $byte_count, chr(0));
			$byte_count --;
		} else {
			$byte_count = floor($ch_order / 8);
			$len = strlen($this->mChapterBuyBits);
			if ($len < $byte_count) 
				$this->mChapterBuyBits .= str_pad(chr(0), $byte_count - $len, chr(0));
		}
		
		$bit = 1 << ($ch_order % 8);
		$byte = ord($this->mChapterBuyBits[$byte_count]);
		$byte |= $bit;
		$this->mChapterBuyBits[$byte_count] = chr($byte);
		$this->mVipCount++;
		$this->mVipMaxOrder = ($this->mVipMaxOrder > $ch_order)? $this->mVipMaxOrder : $ch_order;
		// echo "setting: ".bin2hex($this->mChapterBuyBits)."<br>";
		// set memcache:
		return $this->saveToDb();
	}

	public function setBuyByOrder2($ch_order_from, $ch_order_to ) 
	{	
		if ($ch_order_from >  $ch_order_to) {
			$ch_order =  $ch_order_to;
			$ch_order_to = $ch_order_from;
			$ch_order_from = $ch_order;
		}
			
		if ($this->mChapterBuyBits == null) {
			$byte_count = floor($ch_order_to / 8 + 1);
			$this->mChapterBuyBits = str_pad("", $byte_count, chr(0));
		} else {
			$byte_count = floor($ch_order_to / 8);
			$len = strlen($this->mChapterBuyBits);
			if ($len < $bytes_coun) 
				$this->mChapterBuyBits .= str_pad("", $byte_count - $len, chr(0));
		}
		
		for ($ch_order = $ch_order_from; $ch_order <= $ch_order_to; $ch_order++) {
			$byte_count = floor($ch_order / 8);
			$bit = 1 << ($ch_order % 8);
			$byte = ord($this->mChapterBuyBits[$byte_count]);
			$byte |= $bit;
			$this->mChapterBuyBits[$byte_count] = chr($byte);
			$this->mVipCount++;
		}
		$this->mVipMaxOrder = ($this->mVipMaxOrder > $ch_order_to)? $this->mVipMaxOrder : $ch_order_to;
		// set memcache:
		// saveToDb();
	}
	
	public function saveToDb() 
	{
		$data = array();
		$data['user_id'] = $this->mUserId;
		$data['bk_id'] = $this->mBookId;
		$data['vip_count'] = $this->mVipCount;
		$data['vip_max_order'] = $this->mVipMaxOrder;
		$data['vip_chapters'] = base64_encode($this->mChapterBuyBits);
		// echo "chapter: ". base64_encode($this->mChapterBuyBits)."<br>";
		return M('zl_user_vipbuy')->add($data, array(), true);
	}
}
