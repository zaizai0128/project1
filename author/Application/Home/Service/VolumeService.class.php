<?php
/**
 * 书卷的 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-18
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibBookVolumeModel;

class VolumeService extends ZlibBookVolumeModel {

	/**
	 * 添加卷
	 */
	public function doAdd($data)
	{
		$state = $this->_checkVolume($data);
		if ($state['code'] <= 0) return $state;

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['volume_name'] = $data['name'];
		$final_data['volume_intro'] = $data['intro'];
		$final_data['volume_order'] = parent::getLastVolumeOrder($data['bk_id']);
		$final_data['volume_status'] = 0;
		$result = parent::doAdd($final_data);

		if ($result > 0)
			return z_info($result, '添加成功');
		else
			return z_info($result, '添加失败');
	}

	/**
	 * 修改卷
	 */
	public function doEdit($data)
	{
		$state = $this->_checkVolume($data, True);
		if ($state['code'] <= 0) return $state;

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['volume_name'] = $data['name'];
		$final_data['volume_intro'] = $data['intro'];
		$final_data['volume_id'] = $data['volume_id'];
		$result = parent::doEdit($final_data);

		if ($result > 0)
			return z_info($result, '添加成功');
		else
			return z_info($result, '添加失败');
	}

	/**
	 * 编辑章节的时候选择的卷
	 * @param book_id
	 */
	public function getVolCategory($book_id)
	{
		$volume_list = array();
		$result = (array)parent::getVolumeById($book_id);
		
		if (!empty($result)) {
			foreach($result as $key=>$val) {
				$volume_list[$val['volume_order']] = $val['volume_name'];
			}

		// 如果卷不存在，则显示正文卷 和 作品相关卷
		} else {
			$volume_list = C('BOOK.default_volume');

			// 取消掉垃圾箱
			unset($volume_list['-10']);
		}

		return $volume_list;
	}
	
	/**
	 * 获取书的现有卷
	 *
	 * @param book_id
	 * @param boolean is_intro 是否获取描述
	 */
	public function getVolumeList($book_id, $is_intro = True)
	{
		// $volume_list = C('BOOK.default_volume');
		$volume_list = array();
		// 获取不同卷下有多少章节
		$chapter_instance = new \Zlib\Api\CachedChapter($book_id);
		$result = (array)parent::getVolumeById($book_id);

		if (!empty($result)) {
			if ($is_intro) {
				foreach ($result as $val) {
					$total = count($chapter_instance->getVolumeChapters($val['volume_order']));
					$volume_list[$val['volume_order']] = array(
						'volume_id' => $val['volume_id'],
						'volume_name' => $val['volume_name'],
						'volume_intro' => $val['volume_intro'],
						'chapter_total' => $total,
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

		// 未创建卷的时候，显示系统默认的卷
		} 
		// else {
		// 	if ($is_intro) {
		// 		$total = count($chapter_instance->getVolumeChapters(C('BOOK.start_volume')));
		// 		$volume_list[C('BOOK.start_volume')]['volume_id'] = -1;
		// 		$volume_list[C('BOOK.start_volume')]['volume_name'] = '正文';
		// 		$volume_list[C('BOOK.start_volume')]['volume_intro'] = '系统默认卷正文';
		// 		$volume_list[C('BOOK.start_volume')]['chapter_total'] = $total;
		// 	}
		// }
		return $volume_list;
	}
	
	/**
	 * 验证卷信息是否通过
	 *
	 * @param array 
	 * @param boolean 是否是编辑
	 */
	private function _checkVolume($volume_info, $is_edit = False)
	{
		if (empty($volume_info['bk_id']))
			return z_info(-1, '书号不存在');

		if (empty($volume_info['name']))
			return z_info(-11, '卷名不存在');

		if (in_array($volume_info['name'], array('垃圾箱', '作品相关介绍')))
			return z_info(-3, '禁止使用系统默认卷名');

		if ($is_edit) {
			if (empty($volume_info['volume_id']))
				return z_info(-12, '卷id不存在');

			$extend_where = 'volume_id != '.$volume_info['volume_id'];
			$volume_id = parent::getVolumeByName($volume_info['bk_id'], $volume_info['name'], 'volume_id', $extend_where);	
		} else {
			$volume_id = parent::getVolumeByName($volume_info['bk_id'], $volume_info['name'], 'volume_id');	
		}

		if (!empty($volume_id))
			return z_info(-2, '卷名已经存在');

		return z_info(1, '验证通过');		
	}
}