<?php
/**
 * 用户model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-01
 * @version 1.0
 */
namespace Home\Model;
use Think\Model;

class HomeModel extends Model {

	public function cQuery($sql)
	{
		return $this->query($sql);
	}

}