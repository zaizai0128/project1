<?php
/**
 * 作品 zlib/model
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-22
 * @version 1.0
 */
namespace Zlib\Model;

class ZlibBookModel extends BaseModel {

	protected $bookRankInstance = Null;
	protected $trueTableName = 'zl_book';

	protected function init()
	{
		parent::init();
		$this->bookRankInstance = M('ZlBookRank');
	}

	/**
	 * 获取作品当前的rank信息
	 * @param book_id
	 * @param field
	 */
	public function getBookRankInfo($book_id, $field='*')
	{
		$condition = 'bk_id = '.$book_id;
		return $this->bookRankInstance->field($field)->where($condition)->find();
	}

	/**
	 * 添加rank信息
	 */
	public function addBookRankInfo($data)	
	{
		return $this->bookRankInstance->data($data)->add();
	}

	/**
	 * 修改rank信息
	 */
	public function editBookRankInfo($data)
	{
		$condition = 'bk_id = '.$data['bk_id'];
		return $this->bookRankInstance->where($condition)->data($data)->save();
	}

	/**
	 * 获取作者的书籍
	 * @param int user_id
	 * @param String field
	 * @param String where
	 */
	public function getBookByUserId($user_id, $field='*', $where='')
	{
		$condition = 'bk_author_id = '.$user_id.$where;
		return $this->field($field)->where($condition)->order('bk_cre_time DESC')->select();
	}

	/**
	 * 获取作品信息通过名称
	 * @param String book_name
	 * @param String field
	 * @param String where
	 */
	public function getBookByName($book_name, $field='*', $where='')
	{
		$condition = 'bk_name = "'.$book_name.'"'.$where;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 *  获取作品信息通过作品id
	 * @param String book_id
	 * @param String field
	 * @param String where
	 */
	public function getBookByBookId($book_id, $field='*', $where='')
	{
		$condition = 'bk_id = "'.$book_id.'"'.$where;
		return $this->field($field)->where($condition)->find();
	}

	/**
	 * 添加
	 */
	public function doAdd($data)
	{
		return $this->data($data)->add();
	}

	/**
	 * 编辑
	 */
	public function doEdit($data)
	{
		$condition = 'bk_id = '.$data['bk_id'];
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 删除
	 */
	public function doDelete($data)
	{
		$condition = 'bk_id = '.$data['bk_id'];
		return $this->where($condition)->delete();
	}

	/**
	 * 获取点击排行数据
	 *
	 * @param int book_id
	 * @param String field
	 */
	public function getRank($book_id, $field = '*')
	{
		$condition = 'bk_id = '.$book_id;
		return M('ZlBookRank')->field($field)->where($condition)->find();
	}

	/**
	 * 获取列表总数
	 * @param array 条件数组
	 */
	public function getBookTotal($param = Null)
	{
		return $this->where($param)->count();
	}

	/**
	 * 获取作品列表
	 *
	 * @param array 条件数组
	 * @param array 分页数组
	 */
	public function getBookList($param = Null, $page, $field = '*')
	{
		return $this->field($field)->where($param)->limit($page['firstRow'], $page['listRows'])->order('bk_id desc')->select();
	}

	/**
	 * 屏蔽作品
	 * status 01
	 */
	public function setBookDeny($book_id)
	{
		if (is_array($book_id)) {
			$books = implode(',', $book_id);
			$condition = 'bk_id in('.$books.')';
		} else {
			$condition = 'bk_id = '.$book_id;
		}
		$data['bk_status'] = '01';
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 解封作品
	 */
	public function setBookAllow($book_id)
	{
		if (is_array($book_id)) {
			$books = implode(',', $book_id);
			$condition = 'bk_id in('.$books.')';
		} else {
			$condition = 'bk_id = '.$book_id;
		}
		$data['bk_status'] = '00';
		return $this->where($condition)->data($data)->save();
	}

	/**
	 * 设置封面状态为通过
	 */
	public function setBookCoverAllow($book_id)
	{
		$data['bk_id'] = $book_id;
		$data['bk_cover'] = 1;
		return $this->data($data)->save();
	}

	/**
	 * 设置全本
	 */
	public function setBookFullFlag($book_id)
	{
		$data['bk_id'] = $book_id;
		$data['bk_fullflag'] = 1;
		return $this->data($data)->save();
	}

	/**
	 * 设置封笔
	 */
	public function setBookClose($book_id)
	{
		$data['bk_id'] = $book_id;
		$data['bk_fullflag'] = 2;
		return $this->data($data)->save();
	}

	/**
	 * 获取用户拥有的书籍数量
	 */
	public function getBookTotalByUserId($user_id)
	{
		$condition['bk_author_id'] = $user_id;
		return $this->where($condition)->count();
	}

	/**
	 * 删除
	 * @param int book_id
	 */
	public function del($book_id)
	{
		$data['bk_id'] = $book_id;
		$data['bk_status'] = '01';
		return $this->data($data)->save();
	}
}