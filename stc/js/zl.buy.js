/**
 * 逐浪购买中心js
 * 
 * @author  songmw<songmingwei@kongzhong.com>
 * @date    2014-09-30
 * @version 1.0
 */
jQuery(function(){
		
	$.extend({

		/*
			订阅选中章节
			@param String 购买的地址
		*/
		buyChapter : function(url, success_url)
		{
			var item = $('.choose-item:checked');
			var item_id = new Array;
			$.each(item, function(k, v){

				if ($(v).prop('disabled')) {
					return;
				}
				item_id.push($(v).val());

			});

			if (item_id.length <= 0)
			{
				alert('请选择想要购买的章节');
				return false;
			}

			$.ajax({
				url : url,
				type : 'post',
				data : 'item_id='+item_id,
				success : function(response)
				{
					if(response.code>0) {
						window.location.href=success_url;
					} else {
						alert('订阅失败！请重新尝试！');
						location.reload();
					}
				}
			});
		},

		/*
			选择订阅的章节信息
			并显示多少钱
		*/
		chooseBuy : function()
		{
			var m_button = $('.choose-all');
			var i_button = $('.choose-item:not(:disabled)');

			m_button.on('change', function(){
				var status = $(this).prop('checked');

				if (status) {
					i_button.prop('checked', true);
				} else {
					i_button.prop("checked", false);
				}

				$.getTotalMoney();
			});

			i_button.on('change', function(){
				$.getTotalMoney();
			});
		},

		/*
			计算选中的章节的总价
		 */
		 getTotalMoney : function()
		 {	
		 	var total = $('.choose-need-money');
		 	var item = $('.choose-item:checked');
		 	var price = 0;

		 	$.each(item, function(k, v){
		 		if ($(v).prop('disabled')) {
		 			return;
		 		}

		 		price += parseInt($(v).parents('tr').find('.choose-item-price').html());
		 	});

		 	total.html(price);
		 }


	});


});