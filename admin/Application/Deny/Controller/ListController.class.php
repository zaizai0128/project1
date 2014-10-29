<?php
/**
 * 禁止上榜作品列表
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Deny\Controller;
use Common\Controller\BaseController;
use Zlib\Api\BookBan;

class ListController extends BaseController {

	protected $banInstance = Null;

	public function __construct()
	{
		parent::__construct();

		$this->banInstance = D('BookBan', 'Service');
		// 禁止上榜榜单 1
		$this->banInstance->setType(1);
	}

	/**
	 * 列表
	 */
	public function index()
	{
		$total = $this->banInstance->getBanCount();
		$Page = new \Think\Page($total, C('ADMIN.list_size'));

		$have_page['firstRow'] = $Page->firstRow;
		$have_page['listRows'] = $Page->listRows;
		$list = $this->banInstance->getBanList($have_page);

		$this->assign('list', $list);
		$this->display();
	}

	/**
	 * 添加禁止榜单
	 */
	public function add()
	{
		$this->display();
	}

	/**
	 * 执行添加
	 */
	public function doAdd()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->banInstance->doAddBan($data);

			if ($state['status'] > 0)
				$state['url'] = ZU('deny/list/index', 'ZL_ADMIN_DOMAIN');

			$this->ajaxReturn($state);
		}
	}

	/**
	 * 解封
	 */
	public function check()
	{
		$id = I('get.id');
		$state = $this->banInstance->setAllow($id);

		if ($state > 0)
			$this->success('解封成功', U('deny/list/index'), 1);
		else
			$this->error('解封失败');
	}

}