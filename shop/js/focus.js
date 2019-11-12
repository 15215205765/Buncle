// JavaScript Document
$(function(){
	$("input").focus(function(){
		$(this).attr('placeholder','');
	});
	$("input").blur(function(){
		var cla=$(this).attr('alt');
		$(this).attr('placeholder',cla);
	});
});