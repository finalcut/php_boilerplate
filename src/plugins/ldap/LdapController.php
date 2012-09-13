<?php
	
	namespace marshall\plugins\ldap;
	use \F3 as F3;
	use \Template as Template;
	use \marshall\core\Session as Session;

	class LDAPController extends \marshall\core\BaseController {
		public function __construct(){
			parent::__construct();
		}

		public function loginForm(){
			$session = new Session();
			$session->set("isLoggedIn", true);
			F3::reroute("/");
		}

		public function logout(){
			$session = new Session();
			$session->set("isLoggedIn", false);
			$session->set("username",false);
			$session->set("fullname",false);
			// send back to the homepage
			F3::set("loggedout",true);
			F3::reroute("/");
		}

		
	}

?>