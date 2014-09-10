/**
 * 逐浪网js
 *
 *
 */
jQuery(function(){

	$('.pop').popover({html:true})

	$.extend({
		debug : function(str)
		{
			console.log(str);
		}
	});
});