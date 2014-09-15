<?php
/**
 * 作品 行为类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-12
 * @version 1.0
 */
namespace Home\Behavior;

class BookBehavior {

	protected $data;
	protected $ac;

	/**
	 * 行为入口程序
	 */
	public function run(&$params)
	{
		$this->ac = $params['ac'];
		$this->data = $params['data'];

		switch ($this->ac) {

			// 添加完作品后的动作
			case 'after_add' :
				$this->afterAdd();
				break;

			// 修改完作品后的动作
			case 'after_edit' :
				$this->afterEdit();
				break;
		}
	}

	/**
	 * 添加章节后的操作
	 */
	protected function afterAdd()
	{
		// 更新作者管理权限 书的id
		$author_info = session('author');
		array_push($author_info['book_apply'], $this->data['bk_id']);
		session('author', $author_info);
	}
}