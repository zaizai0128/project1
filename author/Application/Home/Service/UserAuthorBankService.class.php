<?php
/**
 * 作者银行信息 service
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-24
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibUserAuthorBankModel;

class UserAuthorBankService extends ZlibUserAuthorBankModel {

	/**
	 * 保存银行信息
	 */
	public function doAddBank($data)
	{	
		// 进行一些验证 ...
		if (empty($data['user_id'])) return z_info(-1, '用户id不允许为空');

		// 其他验证 ...

		// 查找银行信息
		$bank = parent::getBankInfoByUserId($data['user_id'], 'id,user_id');

		$final_data['bank'] = $data['bank'];
		$final_data['bank_name'] = $data['bank_name'];
		$final_data['bank_num'] = $data['bank_num'];
		$final_data['user_id'] = $data['user_id'];
		
		// 添加
		if (empty($bank)) {
			$result = parent::doAddBank($final_data);
		// 修改
		} else {
			$final_data['id'] = $bank['id'];
			$result = parent::doEditBank($final_data);
		}
		
		if (!empty($result))
			return z_info(1, '保存成功');
		else
			return z_info(0, '保存失败');
	}	

	/**
	 * 获取作者的银行信息
	 *
	 * @param int user_id
	 */
	public function getBankInfoByUserId($user_id)
	{
		return parent::getBankInfoByUserId($user_id);
	}
}