<?php
/**
 * 注册 	
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
namespace Home\Controller;

class RegisterController extends HomeController {

	protected $userInstance = Null;
	protected $key = 'zhul@ngM@ilKey';	// uri加密的key
	protected $mKey = 'REGISTER#SEND_EMAIL#';	// 发送邮件的key
	protected $mKeyExpire = 300;		// 缓冲5分钟

	public function __construct()
	{
		parent::__construct();
		$this->userInstance = D('User', 'Service');
	}

	/**
	 * 注册页面 主 个性化注册
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 执行个性化注册
	 */
	public function doRegister()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->userInstance->doAdd($data);

			if ($state['code'] > 0) {

				$login_data['username'] = $data['username'];
				$login_data['password'] = $data['password'];
				$this->userInstance->doLogin($login_data);

				z_redirect('注册成功', ZU('register/regSuccess'));
			} else {
				z_redirect($state['msg'], '', 1, -1);
			}
		}
	}


	/**
	 * 手机注册
	 */
	public function phone()
	{

		$this->display();
	}

	/**
	 * 邮箱注册
	 */
	public function email()
	{
		$this->display();
	}

	public function doEmail()
	{
		if (IS_POST) {
			$data = I();
			$state = $this->userInstance->doAddByEmail($data);

			if ($state['code'] > 0) {

				// 注册成功，发送邮件到该账户，并跳到邮箱注册成功界面
				$param['uid'] = $state['code'];
				$param['email'] = $data['email'];
				$param['key'] = md5($param['uid'].$param['email'].$this->key);
				$pa = http_build_query($param);
				$url = ZU('register/emailCheck') . '?' . $pa;

				z_redirect('注册成功', $url);
			} else {
				z_redirect($state['msg'], '', 1, -1);
			}
		}
	}

	/**
	 * 邮箱注册成功，等待验证的界面
	 */
	public function emailCheck()
	{
		$key = I('get.key');
		$email = I('get.email');
		$user_id = I('get.uid');
		$the_key = md5($user_id.$email.$this->key);

		if ($key != $the_key)
			z_redirect('验证失败', ZU('index/index'));

		if (ZS('SESSION.user', 'user_id') == $user_id)
			z_redirect('用户已经登录', ZU('user/center'));

		$user_info = $this->userInstance->getUserInfoByUserId($user_id, 'reg_type,user_state');
		if (empty($user_info))
			z_redirect('用户不存在', '', 1, -1);
		if ($user_info['reg_type'] != 2)
			z_redirect('该用户不是邮箱注册用户，无法激活', '', 1, -1);
		if ($user_info['user_state'] != 'N')
			z_redirect('该用户非等待激活用户', '', 1, -1);

		$assign['goto_mail'] = 'http://mail.'.substr($email, stripos($email, '@')+1);
		$assign['email'] = $email;
		$assign['user_id'] = $user_id;

		// 发送邮箱激活验证码 改为异步发送
		$this->sendMailCode($email, $user_id, md5($email.$user_id.$this->key));

		$this->assign('assign', $assign);
		$this->display('mail_check');
	}

	/**
	 * 用户激活
	 */
	public function activeEmail()
	{
		$key = I('get.key');
		$user_id = I('get.uid');
		$email = I('get.email');
		$the_key = md5($email.$user_id.$this->key);

		if ($the_key != $key)
			z_redirect('验证失败', ZU('index/index'));

		$user_info = $this->userInstance->getUserInfoByUserId($user_id, 'user_id,user_name,user_email,reg_type,user_state,user_pwd');

		if (empty($user_info))
			z_redirect('用户不存在', '', 1, -1);
		if ($user_info['reg_type'] != 2)
			z_redirect('该用户不是邮箱注册用户，无法激活', '', 1, -1);
		if ($user_info['user_state'] != 'N')
			z_redirect('该用户非等待激活用户', '', 1, -1);

		// 激活用户
		$final_data['user_id'] = $user_info['user_id'];
		$final_data['user_state'] = 0;
		$final_data['user_true_email'] = $user_info['user_email'];

		$result = $this->userInstance->doEdit($final_data);

		// 激活成功，进行用户登录，并跳转到注册成功界面
		if ($result) {
			$login_data['username'] = $user_info['user_name'];
			$login_data['password'] = $user_info['user_pwd'];
			$this->userInstance->doLogin($login_data);

			z_redirect('激活成功', ZU('register/regSuccess'));
		} else {
			z_redirect('激活失败，重新尝试', '', 1, -1);
		}
	}

	/**
	 * CURL post发送邮箱激活
	 */
	public function sendMailCode($email, $user_id, $key)
	{
		if ($key != md5($email.$user_id.$this->key))
			return z_info(-1, '验证失败');

		$request_data = array();
		$request_data['email'] = $email;
		$request_data['id'] = $user_id;
		$request_data['key'] = $key;
		$request_url = ZU('Register/postMailCode');

		// curl post请求
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, False);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return z_info(1, '发送成功');
	}

	/**
	 * 重新发送激活码
	 */
	public function reSendMailCode()
	{
		if (!IS_POST) return False;

		$email = I('post.email');
		$user_id = I('post.id');
		$key = md5($email.$user_id.$this->key);
		$state = $this->sendMailCode($email, $user_id, $key);
		$this->ajaxReturn($state);
	}

	/**
	 * 发送邮箱验激活证码
	 */
	public function postMailCode()
	{
		if (!IS_POST) return z_info(0, '错误');
		$email = I('post.email');
		$user_id = I('post.id');
		$key = I('post.key');

		// key 验证失败
		if ($key != md5($email.$user_id.$this->key)) return z_info(-1, '验证失败');

		// 锁存在，无法发送邮件
		$mkey = $this->mKey.$email.'#'.$user_id;
		$lockEmail = S($mkey);
		if ($lockEmail) return z_info(-2, '请等'.$this->mKeyExpire.'秒后再发送');

		// 添加缓冲设置，5分钟发一次邮件
		$data['from'] = 'mingwei0529@163.com';
		$data['from_name'] = '逐浪网 - 系统邮件';
		$data['subject'] = '账户激活 - 逐浪网'; // 邮件主题
		$data['email'] = $email;
		$data['id'] = $user_id;

		$param['email'] = $email;
		$param['uid'] = $user_id;
		$param['key'] = md5($email.$user_id.$this->key);
		$http_query = http_build_query($param);

		// 验证地址
		$checkUrl = ZU('register/activeEmail').'?'.$http_query;

		$data['msg'] =<<<HTML
<html><head>   
<meta http-equiv="Content-Language" content="zh-cn">   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
</head>   
<body>   
感谢您注册逐浪网会员，点击按钮完成注册<br/>
<a href="{$checkUrl}" target="_blank">完成注册</a>
</body>   
</html>
HTML;
		$state = \Zlib\Api\Tool::sendMail($data);

		// 发送成功，添加锁
		if ($state['code'] > 0)
			S($mkey, 1, $this->mKeyExpire);
		return $state;
	}

	/**
	 * 注册成功页面
	 */
	public function regSuccess()
	{
		// 用户未登录，无法进入该界面
		if (!ZS('SESSION.user', '?')) {
			z_redirect('用户未登录', ZU('login/index'));
		}

		$user_id = ZS('SESSION.user', 'user_id');
		$user_info = $this->userInstance->getUserInfoByUserId($user_id, 'user_state');

		if (empty($user_info))
			z_redirect('用户不存在', '', 1, -1);
		if ($user_info['user_state'] != '0')
			z_redirect('该用户未被激活', '', 1, -1);

		$this->assign('user_info', ZS('SESSION.user'));
		$this->display('reg_success');
	}

	// 验证码
	public function verify()
	{
		$Verify = new \Think\Verify();
		$Verify->entry();
	}
}