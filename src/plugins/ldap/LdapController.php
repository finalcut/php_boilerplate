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
			if(F3::get("activeDirectory.useActiveDirectory")){
				F3::set("content","ldap/views/loginForm.html");
				$this->addScript('ldap/views/login.js');
				echo Template::serve('core/layout/site.html');
			}
		}

		public function tryLogin(){
			// use request here because POST gets overwritten during validation steps.
			// scrub santizes the input so it can't do xss or injection..
			if(F3::get("activeDirectory.useActiveDirectory")){
				$data = F3::scrub($_REQUEST);


				$adSettings = F3::get("activeDirectory");
				$ldapService = new LdapService($adSettings);
				$logged_in = $ldapService->authenticate($data["username"], $data["password"], false);


				$results = array();

				if($logged_in && !is_a($logged_in, 'marshall\core\Error')){
					$session = new Session();
					$user = $session->get("USER");
					$user->setLoggedIn(true);
					$user->setUsername($data["username"]);
					$user->setIsAdmin($ldapService->isInGroup($data["username"], $adSettings["adminGroups"]));

					/*
						NOTE: if you add any other group checks here you will break easy-compatiablity with getting
						bug fixes for this plugin in the future.  However, this plugin works well so you should feel
						comfortable doing further checks if you need it.
					 */ 



					$session->set("USER",$user);



					$results["status"] = 1;
					$results["message"] = "";

				} else {
					$results["status"] = 0;
					$results["message"] = "Login Failed";
				}

				F3::set('content',json_encode($results));
				echo Template::serve('core/layout/json.html');
			}

		}

		public function logout(){
			$session = new Session();
			$user = $session->get("USER");
			$user->clearAll();
			$session->set("USER",$user);
			// send back to the homepage
			F3::set("loggedout",true);
			F3::reroute("/");
		}


		public function logoutScript(){
			F3::set('content','ldap/views/logout.js');
			echo Template::serve('core/layout/js.html');			
		}

		
	}

?>