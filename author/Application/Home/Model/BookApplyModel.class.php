<?php
/**
 * 作品申请model层
 * 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-11
 * @version 1.0
 */
namespace Home\Model;
use Zlib\Model\BaseModel;

class BookApplyModel extends BaseModel {

	protected $trueTableName = 'zl_book_apply';

	/**
	 * 创建一个作品申请
	 *
	 * @param Array 申请信息
	 */
	public function doAdd($book_info)
	{
		$book_info['bk_cre_time'] = date('Y-m-d H:i:s', time());
		return $this->data($book_info)->add();
	}

	/**
	 * 获取作者待审核作品列表
	 *
	 * @param int user_id
	 */
	public function getApplyList($user_id)
	{
		return $this->where('bk_author_id='.$user_id.' and bk_apply_status != "01"')
				->order('bk_id DESC')->select();
	}

	/**
	 * 获取待审核作品的信息
	 *
	 * @param int book_id
	 * @param int user_id
	 */
	public function getInfo($book_id, $user_id)
	{
		return $this->where('bk_id = '.$book_id.' and bk_author_id='.$user_id.' and bk_apply_status != "01"')
				->find();
	}

	/**
	 * 通过name获取id
	 * @param String name
	 */
	public function getIdByName($book_name)
	{
		return $this->field('bk_id')->where('bk_name = "'.$book_name.'"')->find();
	}

	/**
	 * 获取作者正在审核的书籍
	 *
	 * @param int user_id
	 */
	public function getOwnBook($user_id)
	{
		$rs =  $this->field('bk_id')->where('bk_author_id = '.$user_id)->select();

		if (!empty($rs))
			$rs = array_map(function($val){return $val['bk_id'];}, $rs);
		
		return $rs;
	}
}