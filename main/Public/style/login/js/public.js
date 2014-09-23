// JavaScript Document
//Tab选项卡

function tab(){
  var tBtn=$('.JQ_Btn').find('li');	
      tBtn.click(function (){
		tBtn.removeClass('on');
		$(this).addClass('on');
		//var container=$(this).parents('.JQ_Tab:first')
		//container.find('.JQ_Frm').hide();
		//container.find('.JQ_Frm').eq($(this).index()).show();
    })    
}

function radio(){	
	var rBtn=$('.JQ_Rbtn').find('li');	
        rBtn.click(function (){
		rBtn.removeClass('on');
		$(this).addClass('on');
		$(".JQ_Rtab").find('.JQ_Box').hide();
		$(".JQ_Rtab").find('.JQ_Box').eq($(this).index()).show();
    }) 
}

//添加和删除
function apped(){
	var tDel=$('.ico_tag02');
	var tAdd=$('.ico_tag03')
	var delBox=$('.JQ_Del');
	tDel.live("click",function(){
		$(this).parents('.JQ_Tag:first').hide();	
		})
	tAdd.click(function(){
	  $(this).next().after("<a  href='javascript:;' class='ico_tag02'></a>")	  
	  $(this).parents('.JQ_Tag:first').appendTo(".JQ_Del");
	  $(this).remove();		
		})	
	}


//鼠标滑过效果
function inp_efft(){	
	$(".JQ_Frmlst input").each(function(){
			var inptval=$(this).val();	
			$(this).focus(function(){
			$(this).val("");
				})
			$(this).blur(function(){
			$(this).val(inptval);
				})	
	  })	  
		
}
	  
$(function(){
   tab();//选项卡
   // radio();//注册方式选项
   apped();//作品添加和删除卡
   inp_efft();//鼠标滑过效果
 })

//..