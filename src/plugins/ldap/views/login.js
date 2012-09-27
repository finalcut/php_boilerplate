$(document).ready(function(){
	$("#loginButton").click(function(){

		jQuery.post($("#loginForm").attr("action"), {username: $("#txtUsername").val(), password: $("#txtPassword").val()}, function(data, textStatus, xhr) {
			data = jQuery.parseJSON(data);
			if(data.status ==1){
				$("#loginerror").html("");
				window.location= $("#returnTo").val();
			} else {
				$("#loginerror").html(data.message);
				$("#loginerror").removeClass("hidden");
				$("#loginerror").fadeOut(2000);
			}
		});

		return false;
	
	});



});

