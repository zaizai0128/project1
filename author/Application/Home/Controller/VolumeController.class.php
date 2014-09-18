<?php
/**
 * 分卷管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class VolumeController extends BaseController {

	protected $book_obj;	
	protected $book_id;		// 书籍id 
	protected $book_info;
	protected $volume_obj;

	protected function init()
	{
		parent::init();

		$this->volume_obj = D('Volume', 'Service');
		$this->book_obj = D('Book', 'Service');
		$this->book_id = I('get.book_id');
		$this->checkBookAcl($this->book_id);
		$this->book_info = $this->book_obj->getBookInfo($this->book_id);
	}

	/**
	 * 分卷管理页面
	 */
	public function index()
	{
		// 获取现有的卷
		$volume_list = $this->volume_obj->getVolumeList($this->book_id);

		$this->assign(array(
			'book_info' => $this->book_info,
			'volume_list' => $volume_list
		));
		$this->display();
	}

	/**
	 * 执行新增
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data['bk_id'] = $this->book_id;
			$data['volume_name'] = I('post.volume_name');
			$data['volume_intro'] = I('post.volume_intro');
			$data['volume_order'] = $this->volume_obj->getLastVolumeOrder($this->book_id);
			
			$state = $this->volume_obj->checkVolume($data);

			if ($state['code'] < 0)
				$this->error($state['msg']);

			$state = $this->volume_obj->doAdd($data);

			if (empty($state))
				$this->error('添加失败');
			else
				$this->success('添加成功', ZU('volume/index', 'ZL_AUTHOR_DOMAIN'
				, array('book_id'=>$this->book_id)));
		}	
	}

	/**
	 * 执行修改分卷
	 */
	public function doEdit()
	{
		if (IS_POST) {
			$data = I();
			$data['bk_id'] = $this->book_id;
			
			$state = $this->volume_obj->checkVolume($data, True);

			if ($state['code'] < 0)
				$this->error($state['msg']);

			$state = $this->volume_obj->doEdit($data);

			if (empty($state))
				$this->error('修改失败');
			else
				$this->success('修改成功', ZU('volume/index', 'ZL_AUTHOR_DOMAIN'
				, array('book_id'=>$this->book_id)));
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