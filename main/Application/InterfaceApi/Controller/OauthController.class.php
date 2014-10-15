<?php
/**
 * oauth 
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-15
 * @version 1.0
 */
namespace InterfaceApi\Controller;
use InterfaceApi\Api\Oauth as Oauth;

class OauthController extends InterfaceApiController {
	
	/**
	 * qq
	 */
	public function qq()
	{
		$qq = new Oauth\QQ;

	}

	public function qqBack()
	{

		echo 'qq callback';
	}

}