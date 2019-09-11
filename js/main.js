$(document).ready(function(){
	$('footer .address > div').html("<i class='fa fa-map-marker'></i> "+$('footer .address > div').html())
	$('footer .tel > div').html("<i class='fa fa-phone'></i> "+$('footer .tel > div').html())
	$('footer .calendar > div').html("<i class='fa fa-calendar'></i> "+$('footer .calendar > div').html())
	$('footer .ship > div').html("<i class='fa fa-truck'></i> "+$('footer .ship > div').html())

	// call hotline mobile
	var _w=$(window).width();
	$('.mypage-alo-phone').css("left",(_w-110)/2+"px");
})