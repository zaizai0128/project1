<?php
/**
 * 工具类
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-11
 * @version 1.0
 */
namespace Zlib\Api;

class Tool {

	/**
	 * 手机验证码接口
	 */
	public static function phoneVerify()
	{
		

		echo '发送手机验证码';
	}

	/**
	 * 发送邮件
	 *
	 * @data
	 */
	public static function sendMail($data)
	{
		$mail = new \Zlib\Vendor\Mail\PHPMailer;
		$mail->IsSMTP();	//设置smtp服务器
		$mail->Host = C('EMAIL.host');
		$mail->SMTPAuth = true;
		$mail->Username = C('EMAIL.username');
		$mail->Password = C('EMAIL.password');
		$mail->From = C('EMAIL.username');
		$mail->FromName = $data['from_name'];
		$mail->CharSet = "UTF-8";	// GB2312 据说utf-8在outlook下乱码，有待测试
		$mail->Encoding = "base64";
		$mail->AddAddress($data['email']);
		$mail->IsHTML(true);
		$mail->Subject = $data['subject'];	// 邮件主题  
		$mail->Body = $data['msg'];
		$mail->AltBody ="text/html";

		if(!$mail->Send())    
	    { 	       
	    	return z_info(0, $mail->ErrorInfo);    
	    }
	    return z_info(1, '发送成功');     
	}
}