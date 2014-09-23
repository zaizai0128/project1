/**
 * 逐浪网js
 * 
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-23
 * @version 1.0
 */
jQuery(function(){
	$.extend({

		/**
		* 切换验证码
		* @param string 类名
		*/
		changeVerify : function(class_name)
		{
			var obj = $('.'+class_name);
			var src = obj.attr('src');
			src = src.substr(src.indexOf(src, '?')) + '?' + Math.random() * 10;
			obj.attr('src', src);
		},

		debug : function(str)
		{
			console.log(str);
			return false;
		}
	});
});