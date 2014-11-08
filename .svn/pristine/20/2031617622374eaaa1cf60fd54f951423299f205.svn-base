<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	public $data = '';
	public function __construct(){
		parent::__construct();
		if(!session("?user.id")){
			$this->data['collapsible_menu_value']='dn';
			$this->data['oginTop_value']='';
		}else{
			$this->data['collapsible_menu_value']='';
			$this->data['loginTop_value']='dn';			
		}
	}
}