<?php
/**
 * 审核 service
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-14
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\ZlibChapterAuditModel;

class FilterService extends ZlibChapterAuditModel{

	protected $bookInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->bookInstance = D('Book', 'Service');
	}

	/**
	 * 添加到审核信息 政治级别
	 * 作品被关闭，章节被关闭，级别为政治错误
	 * 
	 */
	public function doAddDeadFilter($data)
	{
		$info = parent::getNotCheckInfo($data['bk_id'], $data['ch_id'], 'id');

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_id'] = $data['ch_id'];
		$final_data['is_vip'] = (int)$data['vip'];
		$final_data['author_id'] = $data['user_id'];
		$final_data['author_name'] = $data['author_name'];
		$final_data['author_lock'] = 1;		// 关闭作品
		$final_data['audit_emergency'] = 2;	// 政治类
		$final_data['audit_name'] = $data['ch_name'];
		$final_data['audit_content'] = $data['ocontent'];
		$final_data['status'] = 0;

		// 添加
		if (empty($info)) {
			$final_data['audit_time'] = $data['ch_cre_time'];
			$final_data['create_time'] = z_now();
			$result = parent::doAdd($final_data);

		} else {
			$final_data['update_time'] = z_now();
			$result = parent::doEdit($final_data);
		}

		// 修改章节状态 待审核
		$chapter_instance = D('Chapter', 'Service')
							->getInstance($final_data['bk_id'], $final_data['ch_id']);
		$chapter_data['ch_status'] = 2;
		$chapter_data['bk_id'] = $final_data['bk_id'];
		$chapter_data['ch_id'] = $final_data['ch_id'];
		$chapter_instance->doEditStatus($chapter_data);
		
		// 修改作品状态为 待审核
		$book_data['bk_id'] = $data['bk_id'];
		$book_data['bk_status'] = '01';
		$this->bookInstance->doEdit($book_data);
	}

	/**
	 * 添加审核信息 严重级别
	 * 章节被关闭，级别为严重错误
	 * 严打期间，作品同时被关闭
	 */
	public function doAddErrorFilter($data)
	{
		$info = parent::getNotCheckInfo($data['bk_id'], $data['ch_id'], 'id');

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_id'] = $data['ch_id'];
		$final_data['is_vip'] = (int)$data['vip'];
		$final_data['author_id'] = $data['user_id'];
		$final_data['author_name'] = $data['author_name'];
		
		// 严打期间，关闭作品
		$final_data['author_lock'] = C('FILTER.filter_scale') == 2 ? 1 : 0;
		$final_data['audit_emergency'] = 1;	// 严重级别
		$final_data['audit_name'] = $data['ch_name'];
		$final_data['audit_content'] = $data['ocontent'];
		$final_data['status'] = 0;

		// 添加
		if (empty($info)) {
			$final_data['audit_time'] = $data['ch_cre_time'];
			$final_data['create_time'] = z_now();
			$result = parent::doAdd($final_data);

		} else {
			$final_data['update_time'] = z_now();
			$result = parent::doEdit($final_data);
		}

		// 修改章节状态 待审核
		$chapter_instance = D('Chapter', 'Service')
							->getInstance($final_data['bk_id'], $final_data['ch_id']);
		$chapter_data['ch_status'] = 2;
		$chapter_data['bk_id'] = $final_data['bk_id'];
		$chapter_data['ch_id'] = $final_data['ch_id'];
		$chapter_instance->doEditStatus($chapter_data);

		// 修改作品状态为 待审核
		if (C('FILTER.filter_scale') == 2) {
			$book_data['bk_id'] = $data['bk_id'];
			$book_data['bk_status'] = '01';
			$this->bookInstance->doEdit($book_data);
		}
	}

	/**
	 * 添加审核信息 普通级别
	 * 章节被关闭，级别为普通错误
	 * 严打期间，作品同时被关闭
	 */
	public function doAddNoticeFilter($data)
	{
		// 获取审核信息，存在则替换，否则添加
		$info = parent::getNotCheckInfo($data['bk_id'], $data['ch_id'], 'id');

		$final_data['bk_id'] = $data['bk_id'];
		$final_data['ch_id'] = $data['ch_id'];
		$final_data['is_vip'] = (int)$data['vip'];
		$final_data['author_id'] = $data['user_id'];
		$final_data['author_name'] = $data['author_name'];
		
		// 严打期间，关闭作品
		$final_data['author_lock'] = C('FILTER.filter_scale') == 2 ? 1 : 0;
		$final_data['audit_emergency'] = 0;
		$final_data['audit_name'] = $data['ch_name'];
		$final_data['audit_content'] = $data['ocontent'];
		$final_data['status'] = 0;

		// 添加
		if (empty($info)) {
			$final_data['audit_time'] = $data['ch_cre_time'];
			$final_data['create_time'] = z_now();
			$result = parent::doAdd($final_data);

		} else {
			$final_data['update_time'] = z_now();
			$result = parent::doEdit($final_data);
		}

		// 修改作品状态为 待审核
		if (C('FILTER.filter_scale') == 2) {
			$book_data['bk_id'] = $data['bk_id'];
			$book_data['bk_status'] = '01';
			$this->bookInstance->doEdit($book_data);
		}
	}
}