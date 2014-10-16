<?php
/**
 * 鲜花 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace App\Service;
use Zlib\Model\ZlibUserFlowerModel;

class FlowerService extends ZlibUserFlowerModel{

	/**
	 * 获取用户对每本书的鲜花使用数
	 *
	 * @param user_id
	 * @param book_id
	 */
	public function getUserBookFlower($user_id, $book_id)
	{
		$result = array();
		$num = parent::getFlower($user_id, 'num');	// 用户拥有的鲜花数
		$result['have_num'] = (int)$num['num'];
		$result['allow_num'] = parent::getUserAllowSendFlower($user_id, $book_id);	// 对该作品还能赠送的鲜花数
	
		return $result;
	}

	/**
	 * 添加鲜花操作
	 */
	public function addFlower($data)
	{
		$state = $this->_check($data);
		if ($state['code'] < 0) return $state;

		$have_num = $data['user_info']['flower']['have_num'];
		$allow_num = $data['user_info']['flower']['allow_num'];
		$num = $data['num'];

		// 结果数组
		$result = array();

		// 开启事务流
		$this->startTrans();

		// 作品增加鲜花数
		$flower_data['bk_id'] = $data['book_info']['bk_id'];
		$flower_data['num'] = $data['num'];
		$result['book'] = D('Book','Service')->addFlower($flower_data);

		// 赠送人减少鲜花数
		$user_data['user_id'] = $data['user_info']['user_id'];
		$user_data['num'] = $data['num'];
		$result['user'] = $this->reduceFlower($user_data);

		// 添加到 赠送鲜花日志表 中
		$log_data['month'] = parent::getNowTime();
		$log_data['user_id'] = $data['user_info']['user_id'];
		$log_data['bk_id'] = $data['book_info']['bk_id'];
		$log_data['type'] = parent::TYPE;
		$log_data['op_time'] = z_now();
		$log_data['operator'] = parent::OPERATOR;
		$log_data['num'] = $data['num'];
		$log_data['show_num'] = $data['num'] * C('APP.log_flower_rate');
		$result['log'] = $this->addSendFlowerLog($log_data);

		// 都通过 commit
		if (array_product($result) >= 1) {
			$this->commit();
			return z_info(1, '赠送成功');

		} else {
			$this->rollback();
			return z_info(0, '赠送失败，请重新尝试');
		}
	}

	/**
	 * 添加鲜花
	 */
	public function costAddFlower($data)
	{
		$final_data['user_id'] = $data['user_id'];
		$final_data['type'] = parent::TYPE;
		$final_data['month'] = parent::getNowTime();

		// 判断是增加还是修改
		$info = parent::getFlower($final_data['user_id'], 'id,total_num,num');

		// 添加
		if (empty($info) && $data['num'] > 0) {

			$final_data['num'] = $data['num'];
			$final_data['total_num'] = $data['num'];
			$rs = parent::doAdd($final_data);

			// 记录日志
			if ($rs) {
				$log_data['month'] = $final_data['month'];
				$log_data['user_id'] = $final_data['user_id'];
				$log_data['op_time'] = z_now();
				$log_data['operator'] = parent::OPERATOR;
				$log_data['num'] = $data['num'];
				$log_data['ip'] = z_ip();
				$rs = parent::addCostAddFlowerLog($log_data);
			}

		} else if(!empty($info) && $data['num'] > 0) {

			$final_data['num'] = (int)($data['num'] + $info['num']);
			$final_data['total_num'] = (int)($data['num'] + $info['total_num']);
			$final_data['id'] = $info['id'];
			$rs = parent::doEdit($final_data);

			// 记录日志
			if ($rs) {
				$log_data['month'] = $final_data['month'];
				$log_data['user_id'] = $final_data['user_id'];
				$log_data['op_time'] = z_now();
				$log_data['operator'] = parent::OPERATOR;
				$log_data['num'] = $data['num'];
				$log_data['ip'] = z_ip();
				$rs = parent::addCostAddFlowerLog($log_data);
			}

		} else {
			$rs = True;
		}
		
		return $rs;
	}

	/**
	 * 验证赠送鲜花环节
	 */
	private function _check($data)
	{
		// 一些基础验证
		// 拥有的鲜花数
		$have_num = $data['user_info']['flower']['have_num'];
		// 最多允许赠送的鲜花数
		$allow_num = $data['user_info']['flower']['allow_num'];
		// 赠送的鲜花数
		$num = $data['num'];

		if ($num > $have_num) {
			return z_info(-1, '您当前的鲜花数不够');

		} else if ($num > $allow_num) {
			return z_info(-2, '超过当前作品所能接受的鲜花数');
		} else if ($num <= 0) {
			return z_info(-3, '请输入大于0的数');
		}

		return z_info(1, '验证通过');
	}
	
}