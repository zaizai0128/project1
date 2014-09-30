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
			修改书架名称
		*/
		setShelfName : function(ajax_url, obj)
		{
			var obj = $(obj);
			var shelf_name = obj.parents('tr').find('.shelf_name').val();

			$.ajax({
				url : ajax_url,
				type : 'post',
				data : 'name='+shelf_name,
				success : function(response)
				{
					if (response.code > 0) {
						alert('修改成功');
					} else {
						alert('修改失败');
					}
				}
			})

		},
		/*
			获取可能感兴趣的小说类型
			@param String ajax地址
		 */
		getLikeTag : function(ajax_url)
		{
			var container = $('.tag_add_container');
			var tags = new Array();
			var max_tags = 4;	// 最大显示标签数

			$.ajax({
				url : ajax_url,
				type : 'post',
				async : false,
				success : function(response)
				{
					var de_json = $.parseJSON(response);
					
					for (var v in de_json) {
						if (v.length <= 2) {
							continue;
						}

						var tag_item = new Array();
						tag_item['class_name'] = de_json[v].class_name;
						tag_item['class_id'] = de_json[v].class_id;
						tags.push(tag_item);
					}
				}
			});

			var length = tags.length;
			var like_tags = new Array();
			for (var k in tags) {
				if (like_tags.length >= max_tags) {
					break;
				}
				var s = parseInt(Math.random()*length);
				var tmp = new Array();
				tmp['class_name'] = tags[s].class_name;
				tmp['class_id'] = tags[s].class_id;
				like_tags.push(tmp);
			}
			
			container.html('');
			for (var k in like_tags) {
				var like_tags_html = '<span class="tag JQ_Tag tag_add_button" style="cursor:pointer;">';
	                like_tags_html += '<i class="ico_tag01"></i>';
					like_tags_html += '<span class="span_l clearfix">';
	                like_tags_html += '<a href="javascript:;" class="ico_tag03"></a>';
	                like_tags_html += '<span class="tag_nam tag_item" data-class="'+like_tags[k].class_id+'" data-name="'+like_tags[k].class_name+'">'+like_tags[k].class_name+'</span>';
	                like_tags_html += '</span></span>';

	            container.append(like_tags_html);
			}

			$.chooseLikeTag();
		},
		
		/*
			选择喜欢的小说类型
		*/
		chooseLikeTag : function()
		{
			var container = $('.tag_container'); // 保存喜欢的小说
			var max_like_books = 5;	// 最大添加的喜爱数
			
			// 选择喜欢的小说
			$('.tag_add_container').find('.tag_add_button').on('click', function(){
				container.css('display', 'block');

				var num = container.find('.tag_like').length;

				if (num >= max_like_books) {
					return false;
				}

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
                like_html += '<input type="hidden" class="tag_like" name="like[]" value="'+category_class+'" />';
                like_html += '<input type="hidden" class="tag_like_name" name="like_name[]" value="'+category_name+'" /></span>';

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
				$(this).find('.drp_box').hide();
			});
		}
	});
});