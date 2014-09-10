<?php
/**
 * 分卷信息
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;
use Zlib\Model as Zmodel;

class Volume {
	private $mVolume = null;

	__construct($book_id) {
		$mVolume = array();
		$m= M('zl_book_volume')->where(' volume_status = 1 and bk_id = '.$bookid)->order('volume asc')->select();
		foreach ($m as $row) {
			$mVolume[$row['volume_order']] = $row;
		}
	}
	
	public function getVolumes() {
		$result = array();
		foreach (list($key, $value) = each($mVolume)) {
			$result[$key] = $value["volume_name"];
		}
		return  $result;
	}
}

?>
