<?php
/**
 * ban作品 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookBanListModel extends BaseModel {

	protected $trueTableName = 'zl_book_banlist';
	protected $type = Null;

	/**
	 * 设置type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * 获取type
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * 获取禁止上榜的列表总数
	 */
	public function getBanCount()
	{
		$condition = 'ban_type = '.$this->type.' and status = 1 and ban_end > now()';
		return $this->where($condition)->count();
	}

	/**
	 * 获取banlist
	 */
	public function getBanList($page, $field = '*')
	{
		$condition = 'ban_type = '.$this->type.' and status = 1 and ban_end > now()';
		return $this->field($field)->where($condition)
					->limit($page['firstRow'], $page['listRows'])->select();
	}

	/**
	 * 解封
	 */
	public function setAllow($id)
	{
		$condition = 'id = '.$id.' and ban_type = '.$this->type;
		$data['status'] = 0;
		$data['disable_time'] = z_now();
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 获取一条数据信息
	 */
	public function getInfo($id, $field='*')
	{	
		$condition = 'id = '.$id.' and ban_type = '.$this->type;
		return $this->field($field)->where($condition)->find();
	}
}