<?php
/**
 * 用户 行为类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-06
 * @version 1.0
 */
namespace Home\Behavior;
use Zlib\Model\ZlibBookShelfModel;

class UserBehavior {

	/**
	 * 行为入口程序
	 */
	public function run(&$params)
	{
		$this->ac = $params['ac'];
		$this->data = $params['data'];

		switch ($this->ac) {

			case 'after_add' :
				$this->afterAdd();
				break;

			case 'after_edit' :
				$this->afterEdit();
				break;
		}
	}

	public function afterAdd()
	{
		// 添加默认书架
		$this->_createShelf($this->data['user_id']);

	}

	/**
	 * 为用户创建默认的书架
	 */
	private function _createShelf($user_id)
	{
		$shelf_instance = new ZlibBookShelfModel;
		$shelf_instance = $shelf_instance->getInstance($user_id);

		$data['user_id'] = $user_id;
		$data['bookshelf_id'] = 0;
		$data['bookshelf_name'] = '默认书架';
		return $shelf_instance->doAddDefault($data);
	}



}