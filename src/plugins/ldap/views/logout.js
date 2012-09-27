$(document).ready(function(){
	$("#lnkLogout").click(function(){


		jQuery.get($(this).attr("href"), {}, function(data, textStatus, xhr) {
			window.location="{{@relroot}}/";
			
		});

		return false;
	
	});



});

