$(document).ready(function(){ 
	var $value= parseInt($('.price-panel .wrapper .cell').text());
	var $currentValue = $value;
	
		function suanyixia(){
			$('input:checked').each(function(){
				if ($(this).hasClass('price-value')){
					$value += parseInt($(this).val());
				}
			});
			$value*=parseInt($('#counter option:selected').text());
			$('.price-panel .wrapper .cell').text($value + " руб.");
			$('#jiage').attr('value',$value);
			$value = $currentValue;
		}
		suanyixia();
		
	  $('.price-value').click(function() {
		suanyixia();
	  });
	  $('#counter').change(function() {
		suanyixia();
	  });
});