<?php
	
	namespace marshall\plugins\ldap;
	use \F3 as F3;
	use \Template as Template;
	use \marshall\core\Session as Session;
	use \marshall\plugins\ldap\services\ldapService as LdapService;

	class LDAPController extends \marshall\core\BaseController {
		public function __construct(){
			parent::__construct();
		}

		public function loginForm(){
			F3::set("content","ldap/views/loginForm.html");
			echo Template::serve('core/layout/site.html');
		}

		public function tryLogin(){
			// use request here because POST gets overwritten during validation steps.
			// scrub santizes the input so it can't do xss or injection..
			$data = F3::scrub($_REQUEST);


			$ldapService = new LdapService(F3::get("activeDirectory"));
			$logged_in = $ldapService->authenticate($data["username"], $data["password"], false);

			if($logged_in && !is_a($logged_in, 'Error')){
				$session = new Session();
				$session->set("isLoggedIn", true);
				$session->set("username",$data["username"]);
				$session->set("isAdmin", $ldapService->is_in_admin_group($data["username"]));
				F3::reroute("/");

			} else {
				F3::reroute("/loginForm");
			}
		}

		public function logout(){
			$session = new Session();
			$session->set("isLoggedIn", false);
			$session->set("username",false);
			$session->set("isAdmin", false);
			// send back to the homepage
			F3::set("loggedout",true);
			F3::reroute("/");
		}

		
	}

?>