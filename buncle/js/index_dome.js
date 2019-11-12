// JavaScript Document
$(function(){
	
	////循环添加合作伙伴logo
	// var arry=['img/buncle_41.png','img/buncle_42.png','img/buncle_43.png','img/buncle_44.png','img/buncle_45.png','img/buncle_46.png','img/buncle_47.png',];
	// $.each(arry,function(index){
	// 	$("#Partner ul").append('<li><img src="'+arry[index]+'" alt=""></li>');
	// });
	
	//粒子特效
	$('#particles').particleground({
    	dotColor: '#5cbdaa',
		lineColor: '#5cbdaa'
  	});
	
	//获取屏幕宽度
	boxWidth();
	function boxWidth(){
		var winW=$('html').width();
		console.log(Math.abs(winW-1170));
		console.log(winW);
		if(winW<1170){
			$(".bg_box").css({
				'width':'1170px',
				'position': 'absolute',
				'top':0,
				'left':Math.abs((winW-1170)),
			});
			$('#sharing').css({
				'width':1240+Math.abs((winW-1170)*2),
				'left':-Math.abs((winW-1170))
			});
			var boxW=$('#sharing').width();
			console.log(boxW);
			$('#sharing i').css({
				'left':(boxW-392)/2
			});
		}else{
			$(".bg_box").css({
				'width':'1170px',
				'position': 'absolute',
				'top':0,
				'left':(winW-1170)/2,
			});
			$('#sharing').css({
				'width':winW,
				'left':-(winW-1170)/2
			});
			
		}
		/*
		;*/
	}
	$(window).resize(function(){
		boxWidth();
	});
	
	
	
	//点击导航栏跳转到相应的模块
	$('#nav ul li').click(function(){
		var index=$(this).index();
		$('#nav ul i').animate({left:index*110+55+index*6},300);
		if(index===1){
			$('body,html').stop().animate({scrollTop:900},400);
		}else if(index>1){
			$('body,html').stop().animate({scrollTop:(index-1)*660+980},400);
			
		}else{
			$('body,html').stop().animate({scrollTop:0},400);
		}
	});
	//可以动态更换banner图片
	// var bg_img="img/iphone.png";

	// function banerBg(){
	// 	var val=$(".baner_img").css("background");
	// 	var indexLi=val.indexOf("img/");
	// 	var indexRi=val.indexOf('")');
	// 	var txte=val.substring(indexLi,indexRi);
	// 	var hr=val.replace(txte,bg_img);
	// 	$(".baner_img").css('background',hr);
	// }
	// banerBg();
	//鼠标移入按钮中显示二维码
	$(".btn").hover(function(){
		$(this).next().css('height','160px');
	},function(){
		$(this).next().css('height',0);
	});
});





































