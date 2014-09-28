/**
 * 逐浪用户中心js
 * 
 * @author  songmw<songmingwei@kongzhong.com>
 * @date    2014-09-28
 * @version 1.0
 */
jQuery(function(){
	$.extend({
		
		/*
			选择喜欢的小说类型
		*/
		chooseLikeTag : function()
		{
			var container = $('.tag_container'); // 保存喜欢的小说
			
			// 选择喜欢的小说
			$('.tag_add_container').find('.tag_add_button').on('click', function(){
				container.css('display', 'block');

				// 判断是否添加
				var isAppend = true;
				var category = $(this).find('.tag_item');
				var category_class = category.attr('data-class');
				var category_name = category.attr('data-name');

				$.each(container.find('.tag_like'), function(k, v){
					var i = $(v).val();

					if (category_class == i) {
						isAppend = false;
						return false;
					}
				});
				
				if (!isAppend) return false;

				var like_html = '<span class="tag JQ_Tag tag_del_button" onclick="$.delLikeTag(this)" style="cursor:pointer;">';
				like_html += '<i class="ico_tag01"></i>';
                like_html += '<span class="span_l"><span  class="tag_nam">'+category_name+'</span>'
                like_html += '<a  href="javascript:;" class="ico_tag02"></a></span>'
                like_html += '<input type="hidden" class="tag_like" name="like[]" value="'+category_class+'" /></span>';

				container.append(like_html);
			});
		},

		/*
			删除喜欢的小说
		 */
		delLikeTag : function(obj)
		{
			$(obj).remove();
		},

		/*
			显示导航菜单
		*/
		showMenu : function()
		{
			$('.tnav_drop').mouseenter(function(){
				$(this).find('.drp_box').animate({
					opacity : 'show'
				}, 500);

			}).mouseleave(function(){
				$(this).find('.drp_box').animate({
					opacity : 'hide'
				}, 500);
			});
		}
	});


	$.showMenu();
	$.chooseLikeTag();
});