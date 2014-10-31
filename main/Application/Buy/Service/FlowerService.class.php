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

	/**
	 * 添加鲜花
	 */
	public function addFlower($data)
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
				$log_data['type'] = parent::TYPE;
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
				$log_data['type'] = parent::TYPE;
				$log_data['num'] = $data['num'];
				$log_data['ip'] = z_ip();
				$rs = parent::addCostAddFlowerLog($log_data);
			}

		} else {
			$rs = True;
		}
		
		return $rs;
	}
}