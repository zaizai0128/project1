<?php
/**
 * 鲜花 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace Buy\Service;
use Zlib\Model\ZlibUserFlowerModel;

class FlowerService extends ZlibUserFlowerModel{

	const OPERATOR = 0;	// 0 用户

	/**
	 * 添加鲜花
	 */
	public function addFlower($data)
	{
		$final_data['total_num'] = (int)($data['total_num'] + $data['num']);
		$final_data['num'] = $final_data['total_num'];
		$final_data['user_id'] = $data['user_id'];
		$final_data['type'] = parent::TYPE;
		$final_data['month'] = parent::getNowTime();

		// 判断是增加还是修改
		$info = parent::getFlower($final_data['user_id'], 'id,total_num');

		if (empty($info)) {
			$rs = parent::doAdd($final_data);

			// 记录日志
			if ($rs) {
				$log_data['month'] = $final_data['month'];
				$log_data['user_id'] = $final_data['user_id'];
				$log_data['bk_id'] = $data['book_info']['bk_id'];
				$log_data['op_time'] = z_now();
				$log_data['operator'] = self::OPERATOR;
				$log_data['num'] = $data['num'];
				$log_data['show_num'] = $data['num'] * C('APP.log_flower_rate');
				$log_data['ip'] = z_ip();
				parent::addSendLog($log_data);
			}

		} else if($info['total_num'] != $final_data['total_num']) {
			$final_data['id'] = $info['id'];
			$rs = parent::doEdit($final_data);

			// 记录日志
			if ($rs) {
				$log_data['month'] = $final_data['month'];
				$log_data['user_id'] = $final_data['user_id'];
				$log_data['bk_id'] = $data['book_info']['bk_id'];
				$log_data['op_time'] = z_now();
				$log_data['operator'] = self::OPERATOR;
				$log_data['num'] = $data['num'];
				$log_data['show_num'] = $data['num'] * C('APP.log_flower_rate');
				$log_data['ip'] = z_ip();
				parent::addSendLog($log_data);
			}

		} else {
			$rs = True;
		}
		
		return $rs;
	}
}