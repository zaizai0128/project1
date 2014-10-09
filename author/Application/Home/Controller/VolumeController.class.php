<?php
/**
 * 分卷管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;

class VolumeController extends HomeController {

	protected $bookId = Null;
	protected $bookInstance = Null;
	protected $volumeInstance = Null;

	protected function init()
	{
		parent::init();
		$this->bookId = I('get.book_id');
		\Zlib\Api\Acl::check($this->authorInfo, $this->bookId);
		$this->bookInstance = D('Book', 'Service');
		$this->volumeInstance = D('Volume', 'Service');

		$book_info = $this->bookInstance->getBookByBookId($this->bookId);
		$this->assign('book_info', $book_info);
	}

	/**
	 * 分卷管理页面
	 */
	public function index()
	{
		// 获取现有的卷
		$volume_list = $this->volumeInstance->getVolumeList($this->bookId);
		$assign['total_volume'] = count($volume_list);

		$this->assign(array(
			'assign' => $assign,
			'volume_list' => $volume_list
		));
		$this->display();
	}

	/**
	 * 添加分卷
	 */
	public function add()
	{
		$this->display();
	}

	/**
	 * 执行新增
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data = array_merge(I(), array('bk_id'=>$this->bookId));
			$state = $this->volumeInstance->doAdd($data);

			if ($state['code'] > 0)
				z_redirect('添加成功', ZU('volume/index', 'ZL_AUTHOR_DOMAIN'
				, array('book_id'=>$this->bookId)));
			else
				z_redirect($state['msg']);
		}	
	}

	/**
	 * 修改
	 */
	public function edit()
	{
		$volume_id = I('get.volume_id');
		$volume_info = $this->volumeInstance->getVolumeInfo($this->bookId,$volume_id);

		$this->assign('volume_info', $volume_info);
		$this->display();
	}

	/**
	 * 执行修改分卷
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = array_merge(I(), array('bk_id'=>$this->bookId));
			$state = $this->volumeInstance->doEdit($data);

			if ($state['code'] > 0)
				z_redirect('修改成功', ZU('volume/index', 'ZL_AUTHOR_DOMAIN'
				, array('book_id'=>$this->bookId)));
			else
				z_redirect($state['msg']);
		}
	}

	/**
	 * 删除分卷
	 */
	public function delete()
	{
		if (IS_POST) {
			
		}
	}

}