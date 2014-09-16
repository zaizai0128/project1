<?php
/**
 * 作品分类
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-09
 * @version 1.0
 */
namespace Zlib\Api;

class BookClass {
	public $mBookClasses = array(); 
	private static $mInstance =  null;

	// php单例需要把造函数封装起来
	private function __construct(){}

	// 未来考虑从memcache中读取
	public static function getInstance() {
		if (!isset(self::$mInstance)) {
			self::$mInstance =  new BookClass();
			$m = M("zl_book_class")->where("class_status=1")->order("class_id asc")->select();
			foreach ($m as $row) {
				if ($row["class_is_leaf"] == 0) {
					$row["class_children"] = array();
				}

				if (strlen($row["class_id"] > 2)) {
					array_push(self::$mInstance->mBookClasses[substr($row["class_id"], 0, 2)]["class_children"], $row["class_id"]); }
				self::$mInstance->mBookClasses[$row["class_id"]] = $row;
			}
		}
		return self::$mInstance;
	}

	public function getName($id) 
	{
		return $this->mBookClasses[$id]["class_name"];
	}

	public function getShortName($id) 
	{
		return $this->mBookClasses[$id]["class_short_name"];
	}

	public function getParent($id) 
	{
		if (strlen($id) <= 2)
			return null;
		return substr($id, 0, -2);
	}

	public function getParentName($id) 
	{
		if (strlen($id) <= 2)
			return null;
		return $this->mBookClasses[substr($id, 0, -2)]["class_name"];
	}

	public function getPath($id) 
	{
		$result = "";
		while (strlen($id) > 0) {	
			$result = $this->mBookClasses[$id]["class_name"]." / ".$result;	
			$id = substr($id, 0, -2);
		}
		return $result;
	}
	
	public function getChildren($id = null) 
	{	
		$result = array();
		if ($id == null) {
			while (list($key, $val) = each($this->mBookClasses)) {
				if (strlen($key) == 2) {
					$result[$key] = $this->mBookClasses[$key]["class_name"];
				}
			} 
		} else if ($this->mBookClasses[$id]["class_is_leaf"] == 0) {
			foreach ($this->mBookClasses[$id]["class_children"] as $child_id) {
				$result[$child_id] = $this->mBookClasses[$child_id]["class_name"];
			}
		}
		return $result;
	}

	public function addChild($id, $name, $short_name) 
	{	
	}

	public function rename($id, $name, $short_name) 
	{	
	}

	public function remove($id)
	{	
		
	}

	/**
	 * 获取指定分类的路径
	 *
	 * @param int 类别id
	 * @return Array 数组name,class_id
	 */
	public function getPathArray($id)
	{
		$result = array();
		while (strlen($id) > 0) {
			$result[$id]['name'] = $this->mBookClasses[$id]['class_name'];
			$result[$id]['short_name'] = $this->mBookClasses[$id]['class_short_name'];
			$result[$id]['class_id'] = $this->mBookClasses[$id]['class_id'];
			$id = substr($id, 0, -2);
		}
		return $result;
	}

	/**
	 * 获取全部顶级分类
	 */
	public function getTopClass()
	{
		$result = array();

		foreach($this->mBookClasses as $key=>$child_id) {

			if ($child_id['class_is_leaf'] != 0)
				continue;

			$result[$key]['class_id'] = $child_id['class_id'];
			$result[$key]['class_name'] = $child_id['class_name'];
			$result[$key]['short_name'] = $child_id['class_short_name'];
		}	

		return $result;
	}

	/**
	 * 获取全部分类，返回json形式
	 */
	public function getAllClassForJson()
	{
		$result = array();

		foreach($this->mBookClasses as $child_id => $child_class) {
			$result[$child_id]['class_id'] = $child_class['class_id'];
			$result[$child_id]['class_name'] = $child_class['class_name'];
			if ($child_class['class_is_leaf'] == 0) {
				$result[$child_id]['class_children'] = $child_class['class_children'];
			}
		}
		
		return json_encode($result);
	}
}
