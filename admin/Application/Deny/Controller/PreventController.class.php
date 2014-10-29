<?php
/**
 * 屏蔽列表
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-29
 * @version 1.0
 */
namespace Deny\Controller;
use Common\Controller\BaseController;
use Zlib\Api\BookBan;
use Zlib\Model\ZlibBookModel;

class PreventController extends BaseController {

	protected $banInstance = Null;
	protected $bookInstance = Null;

	public function __construct()
	{
		parent::__construct();

		$this->banInstance = D('BookBan', 'Service');
		// 屏蔽榜单 0
		$this->banInstance->setType(0);
		$this->bookInstance = new ZlibBookModel;
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
			$state = $this->banInstance->doAddDeny($data);

			// 添加成功， 将作品的状态改为 01 
			if ($state['status'] > 0) {
				$this->bookInstance->setBookDeny(explode('|', trim($data['books'], '|')));
				$state['url'] = ZU('deny/prevent/index', 'ZL_ADMIN_DOMAIN');
			}
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

		if ($state > 0) {
			$info = $this->banInstance->getInfo($id, 'bk_id');
			$this->bookInstance->setBookAllow($info['bk_id']);
			$this->success('解封成功', U('deny/prevent/index'), 1);
		} else {
			$this->error('解封失败');
		}
	}
	
}