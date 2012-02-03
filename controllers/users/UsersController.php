<?php
	require 'model/user.php';

	class UsersController {
		function home(){
			F3::set('html_title', 'Become a User');
			F3::set('content','users/signup.html');
			
			$demo = new User();
			$demo->username="adventure";
			$demo->firstname="Remo";
			$demo->lastname="Williams";
			$demo->role="admin";

			F3::set('user', $demo);
			echo Template::serve('layout.html');
		}
	}
?>