<?php
/**
 * 书卷的 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Home\Service;
use Home\Model\VolumeModel;

class VolumeService extends VolumeModel {

	/**
	 * 获取书的现有卷
	 *
	 * @param book_id
	 * @param boolean is_intro 是否获取描述
	 */
	public function getVolumeList($book_id, $is_intro = True)
	{
		$volume_list = C('BOOK.default_volume');
		$result = (array)self::getVolumeById($book_id);
		if (!empty($result)) {

			if ($is_intro) {
				foreach ($result as $val) {
					$volume_list[$val['volume_order']] = array(
						'volume_id' => $val['volume_id'],
						'volume_name' => $val['volume_name'],
						'volume_intro' => $val['volume_intro'],
					);
				}
			} else {
				$tmp = array();
				foreach ($result as $val) {
					$tmp[$val['volume_order']] = $val['volume_name'];
				}
				foreach ($volume_list as $key => $val) {
					$tmp[$key] = $val;
				}
				$volume_list = $tmp;
			}
		}
		return $volume_list;
	}

	/**
	 * 获取最后卷id
	 * 
	 * @param book_id
	 */
	public function getLastVolumeOrder($book_id)
	{
		$volume = $this->field('max(volume_order) as max')
				->where('bk_id = '.$book_id.' and volume_status = 0')
				->find();
				
		if (empty($volume['max'])) {
			return C('BOOK.start_volume');
		} else {
			return $volume['max']+1;
		}
	}

	/**
	 * 验证卷信息是否通过
	 *
	 * @param array 
	 * @param boolean 是否是编辑
	 */
	public function checkVolume($volume_info, $is_edit = False)
	{
		if (empty($volume_info['bk_id']))
			return array('code'=>-1, 'msg'=>'书号不存在');

		if (empty($volume_info['volume_name']))
			return array('code'=>-11, 'msg'=>'卷名不存在');

		if (in_array($volume_info['volume_name'], array('垃圾箱', '作品相关介绍')))
			return array('code'=>-3, 'msg'=>'禁止使用系统默认卷名');

		if ($is_edit) {
			if (empty($volume_info['volume_id']))
				return array('code'=>-12, '卷id不存在');

			$extend_where = 'volume_id != '.$volume_info['volume_id'];
			$volume_id = self::getVolumeIdByName($volume_info['bk_id'], $volume_info['volume_name'], $extend_where);	
		} else {
			$volume_id = self::getVolumeIdByName($volume_info['bk_id'], $volume_info['volume_name']);	
		}

		if (!empty($volume_id))
			return array('code'=>-2, 'msg'=>'该卷名已存在');
		
		return array('code'=>1, 'msg'=>'验证通过');
	}
}