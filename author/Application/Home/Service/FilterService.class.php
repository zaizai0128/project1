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
	 * 添加到审核信息 敏感词
	 */
	public function doAddDeadFilter($data)
	{
		// 将内容存放到审核表中

		// 修改作品状态为 待审核
		$book_data['bk_id'] = $data['bk_id'];
		$book_data['bk_status'] = '02';
		// $this->bookInstance->doEdit($book_data);
		echo 'dead filter';
		de($data);
	}

	/**
	 * 添加审核信息 普通词
	 */
	public function doAddFilter($data)
	{

	}
}