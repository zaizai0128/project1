/**
 * 逐浪注册登录js
 * 
 * @author  songmw<songmingwei@kongzhong.com>
 * @date    2014-10-08
 * @version 1.0
 */
 jQuery(function($){

 	$.extend({

 		/**
 		 * 性别选择
 		 */
 		chooseSex : function()
 		{
 			$('.sex_lst').find('li').on('click', function(){
 				$(this).addClass('on').siblings('li').removeClass('on');
 				$('.i-sex').val($(this).attr('data-val'));
 			});
 		},

 		/**
 		 * 切换验证码
 		 */
 		changeVerify : function(class_name)
 		{
 			var src = $('.verify_img').attr('src');
 			
 			if (src.indexOf('?') > 0) {
 				src = src.substr(0, src.indexOf('?'));
 			}
 			src = src + '?' + parseInt(Math.random() * 8000);
 			$('.verify_img').attr('src', src);
 		},

 		/**
 		 * 验证邮箱
 		 *
 		 */
 		checkEmail : function(url, class_name)
 		{
 			var email = $('.'+class_name).val().replace(/\s+/, '');
 			if (email == '') return false;

 			$.ajax({
 				url : url,
 				type : 'post',
 				data : 'email='+email,
 				async : false,
 				success : function(response)
 				{
 					var err = $('.i-email-error');
 					if (response.code <= 0) {
 						userErr.push(response.msg);
 						err.css('display', 'block');
 						err.find('.txt').html(response.msg);
 					} else {
 						userErr.pop();
						err.find('.txt').html('');
						err.css('display', 'none')
 					}
 				}
 			});
 		},

		/**
		* 验证用户名
		*/
		checkUsername : function(url, class_name)
		{
			var username = $('.'+class_name).val().replace(/\s+/, '');

			if (username == '') return false;

			$.ajax({
			  url : url,
			  data : 'username='+username,
			  type : 'post',
			  async: false,
			  success : function(response)
			  {
			    var err = $('.i-username-error');
			    if (response.code <= 0) {

			      // 将错误放到数组中
			      userErr.push(response.msg);
			      err.css('display', 'block')
			      err.find('.txt').html(response.msg);
			    } else {
			      userErr.pop();
			      err.find('.txt').html('');
			      err.css('display', 'none')
			    }
			  }
			});
		},

		/**
		 * 验证邮箱注册
		 *
		 */
		checkRegsiterEmail : function()
		{
			var err = $('.error-info');
			var msg = new Array();
			var isOk = false;

			var email = $('.i-email').val().replace(/\s+/, '');
			var pwd = $('.i-password').val().replace(/\s+/, '');
			var repwd = $('.i-repassword').val().replace(/\s+/, '');
			var iagree = $('.iagree:checked').val();

			if (email == '') msg.push('邮箱不允许为空');
			if (pwd == '') msg.push('密码不允许为空');
			if (repwd == '') msg.push('确认密码不允许为空');
			if (pwd != repwd) msg.push('二次密码不一致');
			if (iagree == undefined) msg.push('未选中我同意');

			// 有错误
			if (msg.length > 0 || userErr.length > 0) {
				var err_html = '';
				$.each(msg, function(i, v){
					err_html += v+'|';
				});
				err.html(err_html);
				isOk = false;
			} else {
				isOk = true;
			}
			return isOk;
		},

		/**
		* 验证提交
		*/
		checkRegsiter : function()
		{
			// 错误信息存放
			var err = $('.error-info');
			var msg = new Array();
			var isOk = false; // 判断是否允许提交

			var username = $('.i-username').val().replace(/\s+/, '');
			var password = $('.i-password').val().replace(/\s+/, '');
			var repassword = $('.i-repassword').val().replace(/\s+/, '');
			var verify = $('.i-verify').val().replace(/\s+/, '');

			if (username == '') msg.push('用户名不允许为空');
			if (password == '') msg.push('密码不允许为空');
			if (repassword == '') msg.push('确认密码不允许为空');
			if (password != repassword) msg.push('二次密码不一致');
			if (verify == '') msg.push('验证码不允许为空');

			var iagree = $('.iagree:checked').val();
			if (iagree == undefined) msg.push('未选中我同意');

			if (msg.length > 0 || userErr.length > 0) {
			  var err_html = '';
			  $.each(msg, function(i, v){
			    err_html += v+'|';
			  });
			  err.html(err_html);
			  isOk = false;
			} else {
			  isOk = true;
			}

			return isOk;
		}

    });

 });