<?php

	namespace php_boilerplate\plugins\users;
	use \F3 as F3;
	use \Template as Template;

	class Users extends \marshall\core\BaseController {
		function home(){
			F3::set('html_title', 'Become a User');
			F3::set('content','users/views/signup.html');
			
			$demo = new \php_boilerplate\plugins\users\model\User;
			$demo->username="adventure";
			$demo->firstname="Remo";
			$demo->lastname="Williams";
			$demo->role="admin";

			F3::set('user', $demo);
			echo Template::serve('core/layout/site.html');
		}
	}
?>