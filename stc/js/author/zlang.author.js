/**
 * 逐浪 作者站js
 *
 * @author songmw
 */
jQuery(function(){

	$.extend({

		/**
		 * 如果作品状态选择的是封闭，则提醒
		 */
		checkedAlert : function(class_name)
		{
			$('.'+class_name).on('change', function(){
				if ($(this).val() == 2) {
					if (window.confirm('选择封笔后，无法再编辑该作品，您确定？')) {
						$(this).prop('checked', true);
					} else {
						$(this).prop('checked', false);
						$(this).parent('label').siblings().first().find('input').prop('checked', true);
					}
				}
			});
		},

		/**
		 * 验证提交
		 */
		submitApply : function(ajax_url)
		{
			var isOk = false;
			var err = new Array();
			var err_msg = new Array();
			var book_name = $('.bk_name').val().replace(/\s+/, '');

			if (book_name == '') {
				err_msg['err_bk_name'] = '作品名称不允许为空';
				err.push(1);
			} else {
				reback = $.bookNameExists(ajax_url, book_name);

				if (!reback) {
					err_msg['err_bk_name'] = '作品名称已存在';
					err.push(2);
				} else {
					err_msg['err_bk_name'] = '';
				}
			}

			if (err.length>0) {
				for (var k in err_msg) {
					$('.'+k).html(err_msg[k]);
				}
			} else {
				isOk = true;
			}

			return isOk;
		},

		/**
		 * 验证申请作品名称是否重复
		 *
		 */
		bookNameExists : function(ajax_url, book_name)
		{
			var reback = false;

			$.ajax({
				url : ajax_url,
				type : 'post',
				data : 'name='+book_name,
				async : false,
				success : function(response)
				{
					if (response.code > 0)
						reback = true
				}
			});

			return reback;
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
		},

		// 左右隐藏显示
		leftHide : function()
		{
			//左右显示隐藏
			var $cutbut=$(".cutbut");
			var $cutleft=$(".cutleft");
			var $cutright=$(".cutright");
			var rgao=$cutright.height();
			$(".cutbox").css('height',rgao+'px');
			$(".cutleft").css('height',rgao+'px');
			$(".cutright").css('height',rgao+'px');
			$cutbut.click( function(){
				if($cutleft.is(":visible")){
					$cutleft.hide();
					$cutbut.addClass("cuton");	
					$cutright.addClass("cutron");	
				  }else{
					$cutleft.show();
					$cutbut.removeClass("cuton");	
					$cutright.removeClass("cutron");	
				  }
				return false;
			});
		},

		// tab切换
		chapterTab : function()
		{
			var dts = $(".tabs li");
			var tabCons = $(".cons");
			var i = tabCons.length;
			dts.click(function() {
				i = $(this).index();
				dts.removeClass("active").eq(i).addClass("active");
				tabCons.hide().eq(i).show();
			});
		},

		// 行切换
		lineTab : function()
		{
			$(".leftnav").click(function(){
				$(this).addClass("highlight").children("dd").show().end().siblings().removeClass("highlight").children("dd").hide();
			});
		}
	});

	
	
	

});