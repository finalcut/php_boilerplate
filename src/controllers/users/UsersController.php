<?php

	namespace php_boilerplate\controllers\users;

	class UsersController extends \php_boilerplate\controllers\BaseController {
		function home(){
			\F3::set('html_title', 'Become a User');
			\F3::set('content','users/signup.html');
			
			$demo = new \php_boilerplate\model\User;
			$demo->username="adventure";
			$demo->firstname="Remo";
			$demo->lastname="Williams";
			$demo->role="admin";

			\F3::set('user', $demo);
			echo \Template::serve('layout/site.html');
		}
	}
?>