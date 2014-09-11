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
		 * 生成关联select选择就
		 *
		 * @param String 主select类名
		 * @param String 子select类名
		 * @param Json json数据
		 */
		 selectChoose : function(main_obj, child_obj, json)
		 {
		 	var main_obj = $('.'+main_obj);
		 	var child_obj = $('.'+child_obj);
		 	var json_obj = $.parseJSON(json);		 	
		 	var main_html = '';
		 	var child_html = '';

		 	// 生成主列表
		 	$.each(json_obj, function(k, v){
		 		if (v.class_children != undefined) {
		 			main_html += '<option value="'+v.class_id+'">'+v.class_name+'</option>';
		 		}
		 	});
		 	main_obj.html(main_html);

		 	var main_id = main_obj.find('option:first').val();

		 	// 循环主分类下的子分类
		 	for (var k in json_obj[main_id].class_children) {
		 		var val = json_obj[main_id].class_children[k];
		 		child_html += '<option value="'+json_obj[val].class_id+'">'+json_obj[val].class_name+'</option>';
		 	}

			child_obj.html(child_html);

			// 添加选择事件
			main_obj.on('change', function(){
				child_html = '';
		 		main_id = $(this).find('option:selected').val();

			 	for (var k in json_obj[main_id].class_children) {
			 		var val = json_obj[main_id].class_children[k];
			 		child_html += '<option value="'+json_obj[val].class_id+'">'+json_obj[val].class_name+'</option>';
			 	}
				child_obj.html(child_html);
		 	});					 	
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