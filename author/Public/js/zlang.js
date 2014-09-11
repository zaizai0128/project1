/**
 * 逐浪 作者站js
 *
 *
 */
jQuery(function(){

	$('.pop').popover({html:true})

	$.extend({
		// 调试函数
		debug : function(str)
		{
			console.log(str);
		},

		/**
		 * select的option选择后跳转的函数
		 *
		 * @param Object select对象 this
		 * @param String url要跳转的地址
		 * @param String 串传过去的参数名
		 * @param String 选择0时跳到的url
		 */
		selectChangeUrl : function(obj, url, key_name, default_url)
		{
			var val = $(obj).find('option:selected').val();
			var redirect_url = default_url;
			
			if (val > 0)
				redirect_url = url + '?' + key_name + '=' + val;
			window.location.href=redirect_url;
		}
	});
});