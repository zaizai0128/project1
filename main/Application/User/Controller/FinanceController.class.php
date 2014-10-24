<?php
/**
 * 账号金融财政
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-17
 * @version 1.0
 */
namespace User\Controller;
use Zlib\Model\ZlibBillModel;

class FinanceController extends UserController {

	const PAGE_LIST = 30;	// 30条分页
	protected $billInstance = Null;

	public function __construct()
	{
		parent::__construct();
		$this->billInstance = new ZlibBillModel;
	}

	/**
	 * 个人账户信息
	 */
	public function index()
	{

		$this->display();
	}

	/**
	 * 	充值记录
	 */
	public function recharge()
	{


		$this->display();
	}

	/**
	 * 消费记录
	 */
	public function cost()
	{
		$total = $this->billInstance->getBillTotal($this->userId);
		$Page = new \Think\Page($total, self::PAGE_LIST);
		
		$have_page['firstRow'] = $Page->firstRow;
		$have_page['listRows'] = $Page->listRows;
		$bill_list = $this->billInstance->getBillList($this->userId, $have_page);

		$this->assign(array(
			'page' => $Page->show(),
			'bill_list' => $bill_list,
		));
		$this->display();
	}

	/**
	 * 消费明细
	 */
	public function costDetail()
	{
		$order_id = I('get.id');
		$total = $this->billInstance->getBillDetailTotal($this->userId, $order_id);
		$Page = new \Think\Page($total, self::PAGE_LIST);

		$have_page['firstRow'] = $Page->firstRow;
		$have_page['listRows'] = $Page->listRows;
		$bill_info = $this->billInstance->getBillDetail($this->userId, $order_id, $have_page);

		if (empty($bill_info)) z_redirect('信息不存在', '', 2, -1);
		$assign['total'] = $total;
		$show = $Page->show();

		$this->assign(array(
			'assign' => $assign,
			'bill_info' => $bill_info,
			'page' => $show,
		));
		$this->display();
	}

}