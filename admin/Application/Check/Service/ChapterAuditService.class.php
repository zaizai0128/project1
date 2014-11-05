<?php
/**
 * 章节审核 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-04
 * @version 1.0
 */
namespace Check\Service;
use Zlib\Model\ZlibChapterAuditModel;
use Zlib\Api\FilterWords;
use Zlib\Model\ZlibChapterModel;
use Zlib\Model\ZlibChapterVipModel;

class ChapterAuditService extends ZlibChapterAuditModel {

	public $filterInstance = null;

	public function __construct()
	{
		parent::__construct();
		$this->filterInstance = FilterWords::getInstance();
		$this->filterInstance->mReplaceWord = '';
	}
	
	/**
	 * 获取问题章节，关键字会标红
	 */
	public function getCheckInfo($id)
	{
		$info = parent::getCheckInfo($id);
		$content = $info['audit_content'];
		$arr = $this->filterInstance->filterStyle($content);
		$info['content'] = $arr;

		return $info;
	}

	/**
	 * 设置章节的解封状态
	 */
	public function setChapterStatus($data)
	{
		if ($data['status'] == 0)
			return z_ajax_info(-1, '请选择审核状态');

		// 如果是拒绝
		if ($data['status'] == 2) {
			return $this->setDeny($data);
		}

		// 审核通过的操作
		$content = $data['content'];
		$filters = $this->filterInstance->getFilterWord($content);

		// 如果有问题，则返回false，提示有问题词汇
		if (count($filters) > 0)
			return z_ajax_info(-2, '文中仍有问题词汇【'.implode(',', $filters).'】');

		// 一切验证成功后执行
		$rs = $this->editAudit($data);

		$chapter_data['bk_id'] = $data['bk_id'];
		$chapter_data['ch_id'] = $data['ch_id'];
		$chapter_data['ch_status'] = 0;	// 验证通过，设置章节状态为0，正常
		$chapter = new ZlibChapterModel;
		$chapter_instance = $chapter->getInstance($data['bk_id'], $data['ch_id']);
		$chapter_instance->doEdit($chapter_data);

		// 判断章节类型，更新章节内容
		if ($data['is_vip'] == 1) {
			$vip = new ZlibChapterVipModel;
			$vip_instance = $vip->getInstance($data['bk_id'], $data['ch_id']);
			$vip_instance->setChapterContent($content);

		} else {
			$chapter_instance->setChapterContent($data['ch_id'], $content);
		}

		// 是否同时修改作品的状态？
		
		return $rs ? z_ajax_info(1, '审核成功') : z_ajax_info(0, '审核失败');
	}

	/**
	 * 设置拒绝
	 */
	public function setDeny($data)
	{
		$rs = $this->editAudit($data);

		// 修改章节
		$chapter = new ZlibChapterModel;
		$chapter_instance = $chapter->getInstance($data['bk_id'], $data['ch_id']);
		$chapter_info = $chapter_instance->getChapterInfo();

		$chapter_data['ch_status'] = 1;	// 问题章节审核拒绝，该章节状态为1 关闭
		$chapter_data['bk_id'] = $chapter_info['bk_id'];
		$chapter_data['ch_id'] = $chapter_info['ch_id'];
		$chapter_instance->doEdit($chapter_data);

		return $rs ? z_ajax_info(1, '审核成功') : z_ajax_info(0, '审核失败');
	}

	/**
	 * 修改audit记录
	 */
	private function editAudit($data)
	{
		$audit_data['id'] = $data['id'];
		$audit_data['status'] = $data['status'];
		$audit_data['admin_id'] = ZS('SESSION.admin', 'user_id');
		$audit_data['admin_name'] = ZS('SESSION.admin', 'user_nickname');
		$audit_data['audit_note'] = $data['audit_note'];
		$audit_data['audit_time'] = z_now();

		// 修改审核记录
		return $this->data($audit_data)->save();
	}

	
}