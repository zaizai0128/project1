<?php
/**
 * 申请作品的行为类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-15
 * @version 1.0
 */
namespace Home\Behavior;
use Zlib\Api as Zapi;

class BookApplyVipBehavior {

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

			// 作品审核通过后执行的动作
			case 'after_check_allow' :
				$this->afterCheckAllow();
				break;
		}
	}

	/**
	 * 签约成功以后
	 */
	public function afterCheckAllow()
	{
		// 更新作品的签约状态
		$book_obj = D('Book', 'Service');
		$book_obj->doEditCommision($this->data);

	}

}