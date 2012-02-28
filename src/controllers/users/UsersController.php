<?php
	require_once 'controllers/BaseController.php';
	require_once 'model/user.php';

	class UsersController extends BaseController {
		function home(){
			F3::set('html_title', 'Become a User');
			F3::set('content','users/signup.html');
			
			$demo = new User();
			$demo->username="adventure";
			$demo->firstname="Remo";
			$demo->lastname="Williams";
			$demo->role="admin";

			F3::set('user', $demo);
			echo Template::serve('layout/site.html');
		}
	}
?>