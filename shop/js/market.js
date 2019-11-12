// JavaScript Document
$(function(){
	//获取屏幕宽度；
	windWid();
	function windWid(){
		var w=$('body').width();
		$("html").css({"font-size":(w/10)+'px'});
	}
	//监听窗口变化
	$(window).resize(function(){
		windWid();
	});
	//动态添加banner；
	var num=0;
	var winW=$('body').width()/10;
	var bannerArry=['img/market/banner_01.jpg','img/market/banner_02.png','img/market/banner_03.png','img/market/banner_04.png'];
	for(var i=0;i<bannerArry.length;i++){
		$('#banner ul').append('<li><a href="###"><img src="'+bannerArry[i]+'"></a></li>');
		$('#banner ol').append('<li></li>');
	}
	var img_W=$('#banner ul li').eq(0).width();
	var clone=$('#banner ul li').eq(0).clone();//克隆第一个banner
	$('#banner ul').append(clone);
	var leng=$('#banner ul li').length;
	$('#banner ul').width(img_W*leng+winW);
	$('#banner ol li').eq(0).css('background','#0166fe');
	$('#banner ol').width((bannerArry.length+1)*(winW*0.38)).css({
		'margin-left':-(winW-winW*0.38)/2,
	});
	$("#banner ul").on("Swipeleft",function(){
		moveL();
	});
	$("#banner").on("taphold",function(){
		moveR();
	});
	function moveR(){ //向滑动切换轮播图函数
		num++;
		if(num>bannerArry.length){
			num=1;
			$('#banner ul').css('left',0);
		}else if(num===bannerArry.length){
			$('#banner ol li').eq(0).css('background','#0166fe').siblings().css('background','#fff');
		}
		$('#banner ul').stop().animate({'left':-num*(winW*8.7)},500);
		$('#banner ol li').eq(num).css('background','#0166fe').siblings().css('background','#fff');
	}
	function moveL(){   //向左滑动换轮播图函数
		num--;
		if(num===-1){
			$('#banner ul').css('left',-(bannerArry.length)*(winW*8.7));
			num=bannerArry.length-1;
		}
		$('#banner ul').stop().animate({'left':-num*(winW*8.7)},500);
		$('#banner ol li').eq(num).css('background','#0166fe').siblings().css('background','#fff');
		//$('#banner ol li').eq(num).addClass('key').siblings().removeClass('key');
	}
	//setInterval(moveR,3000);  //自动轮播函数
	
	
	
	//兑换活动倒计时
	var shiT=Number($('.shi').text());
	var fenT=Number($('.fen').text());
	var miaoT=Number($('.miao').text());
	function punTion(){
		miaoT--;
		if(miaoT<0){
			miaoT=59;
		}
		$('.miao').text(miaoT);
		
		if(miaoT===0){
			fenT--;
		}
		$('.fen').text(fenT+59);
		if(fenT===-60){
			fenT=0;
			shiT--;
			
		}
		$('.shi').text(shiT);
		if(miaoT<10){
			$('.miao').text('0'+miaoT);
		}
		if(fenT<-49){
			$('.fen').text('0'+(fenT+59));
		}
		if(shiT<10){
			$('.shi').text('0'+shiT);
		}
			
	}
	setInterval(punTion,1000);
	
	
});

