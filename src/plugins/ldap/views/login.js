$(document).ready(function(){
	$("#loginButton").click(function(){

		jQuery.post($("#loginForm").attr("action"), {username: $("#txtUsername").val(), password: $("#txtPassword").val()}, function(data, textStatus, xhr) {
			data = jQuery.parseJSON(data);
			if(data.status ==1){
				window.location= $("#returnTo").val();
			}
		});

		return false;
	
	});



});

