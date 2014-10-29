/**
 * 逐浪网后台js
 * @author songmw
 */
jQuery(function($){

	$.extend({

		// 初始化menu标签状态
		initStatucMenu : function()
		{
			$('#subnav').find('i').removeClass('icon-unfold').addClass('icon-fold');
			$('#subnav').find('ul').removeClass('subnav-on').addClass('subnav-off').hide();	
		},

		initMenu : function()
		{
			$('.menu-tab').find('li').on('click', function(e){
				var t = $(this);
				t.addClass('current').siblings('li').removeClass('current');

				// 获取被点击显示的类
				var t_tag = $('.'+t.attr('sub-target'));
				// 第一个sidebar标签
				var tag_node = t_tag.find('h3:first');

				// 判断，如果对象不存在，则停止标签运行
				if (t_tag.length<=0) {
					return false;
				}

				// 初始化标签状态
				$.initStatucMenu();
				t_tag.show().siblings().hide();
				tag_node.find('i').toggleClass('icon-fold');
				tag_node.next().removeClass('subnav-off').addClass('subnav-on').show();

			});

			// 默认是第一个打开
			var first_instance = $('.menu-tab').find('li:first');
			var first_tag = $('.'+first_instance.attr('sub-target'));
			var first_node = first_tag.find('h3:first');
			first_instance.addClass('current').siblings('li').removeClass('current');
			first_tag.show().siblings().hide();
			first_node.find('i').removeClass('icon-fold').addClass('icon-unfold');
			first_node.next().removeClass('subnav-off').addClass('subnav-on').show();
		},

		/**
		 * 控制后台menu
		 *
		 * @param String menu_name			顶级类名
		 * @param String second_name		二级类名
		 * @param String third_name			三级类名
		 */
		menu : function(menu_name, second_name, third_name)
		{
			$.initStatucMenu();
			
			// 设置js默认参数
			var second_name = arguments[1] || '';
			var third_name = arguments[2] || '';
			
			// menu类名
			var menu_instance = $('.menu-tab').find('.menu-tab-'+menu_name);
			var subnav_attr = menu_instance.attr('sub-target');
			var subnav_instance = $('.'+menu_instance.attr('sub-target'));

			if (second_name != '') {
				var second_instance = subnav_instance.find('.'+subnav_attr+'-'+second_name);
			} else {
				var second_instance = subnav_instance.find('h3:first');
			}
			// 顶级
			menu_instance.addClass('current').siblings().removeClass('current');
			// side
			subnav_instance.show().siblings().hide();

			// 二级菜单
			second_instance.find('i').removeClass('icon-fold').addClass('icon-unfold');
			second_instance.next('ul').removeClass('subnav-off').addClass('subnav-on').show();

			// 三级
			if (third_name != '') {
				var third_instance = second_instance.next('ul').find('.item-'+third_name).parent('li');
				third_instance.addClass('current').siblings().removeClass('current');
			}
		}

	});

	// 初始化后台menu
	$.initMenu();
});