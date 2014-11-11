<?php
/**
 * 作者管理
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-11-11
 * @version 1.0
 */
namespace Author\Controller;
use Common\Controller\BaseController;

class IndexController extends BaseController {

	protected $authorInstance = null;
	public $search_type = array('用户名', '笔名', '作者id', '手机号');

	public function __construct()
	{
		parent::__construct();
		$this->authorInstance = D('Author', 'Service');
		$this->assign('search_type', $this->search_type);
	}

	/**
	 * 作者列表
	 */
	public function index()
	{
		if (IS_GET) {
			$map = I();
			$map = z_array_filter($map, false);
			if (empty($map)) z_redirect('请选择条件', ZU('Admin/Author/select', 'ZL_ADMIN_DOMAIN'));

			// 判断搜索类型
			switch($map['name_type']) {
				case 0 :
					$where['u.user_name'] = array('LIKE', '%'.$map['name'].'%');
					break;
				case 1 :
					$where['a.author_name'] = array('LIKE', '%'.$map['name'].'%');
					break;
				case 2 :
					$where['a.user_id'] = $map['name']; 
					break;
				case 3 :
					$where['u.user_mobile'] = $map['name'];
					break;
			}

			$total = $this->authorInstance->getTotal($where);
			$data = $this->authorInstance->getList($where);
		
			$this->assign('data', $data);
			$this->assign('map', $map);
			$this->display();
		}
	}

	/**
	 * 作者查询
	 */
	public function select()
	{
		$this->display();
	}

	/**
	 * 查看作者信息
	 */
	public function show()
	{
		$user_id = I('get.user_id');
		$info = $this->authorInstance->getAuthorAllInfoByUserId($user_id);
		
		$this->assign('user_info', $info);
		$this->display();
	}


}