<?php
	class UsersController {
		function home(){
			F3::set('html_title', 'Become a User');
			F3::set('content','users/signup.html');
			echo Template::serve('layout.html');
		}
	}
?>