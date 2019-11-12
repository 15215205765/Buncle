// JavaScript Document
$(function(){
	//选择应用类别
	$('.box_opt').click(function(){
		$(".sel_box").stop().slideToggle(300);
	});
	
	$('.opt_txt').click(function(){
		var vue=$(this).text();
		$(this).css({'color':'#fff','background':'#0166fe'}).siblings().css({'color':'#333','background':'#fff'});
		$('.opt_title').css({'color':'#e1e1e1'});
		$('.box_opt').text(vue).css('color','#333');
		$(".sel_box").stop().slideUp(300);
		var agent = parseInt($(this).attr('data-type'));
		$('#agent').val(agent);
	});

	$('.inp_box input').click(function(){
		var val=$(this).val();
		if(val==='no'){
			$('.mod_box').hide();
		}else{
			$('.mod_box').show();
		}
	});
	//#/点击切换是否赞助
	$('.bt_yes').css({'background': '#0166fe'});
	$('.inp_bt').click(function(){
		var text=$(this).attr("data-add");
		if(text==="yes"){
			$('.bt_yes').css({'background': '#0166fe'});
			$('.bt_no').css({'background': '#fff'});
			$('.mod_box').show();
			$('#zanzhu').val(1);
		}else{
			$('.bt_no').css({'background': '#0166fe'});
			$('.bt_yes').css({'background': '#fff'});
			$('.mod_box').hide();
			$('#zanzhu').val(0);
		}
	});
	$('.img_all').change(function(){
		var nem=$(this).find('input').val();
		var indexLi=nem.substring(11);
		$(this).find('img').attr('src','img'+indexLi+'');
		var imgW=$(this).find('img').height();
		$(this).find('img').css('top',(300-imgW)/2);
		console.log(imgW);
	});
	
});

