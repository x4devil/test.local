$(function () {
	$('input.checkrequest').click(function(){
		$(".modal_bg").css({"width":$(document).width(),"height":$(document).height()});
		$(".modal_bg, .modal_window").fadeIn(800);
		
		var top = $(document).scrollTop() + $(window).height()/2 - $(".modal_window").height()/2;
		$(".modal_window").css({"top":top+"px","display":"block"});

		$("body").css({"overflow":"hidden"});
		return false;
	});

	$(".modal_bg, .modal_window").click(function () {
		$(".modal_bg, .modal_window").fadeOut(800);
		$("body").css({"overflow":"auto"});
	});

});