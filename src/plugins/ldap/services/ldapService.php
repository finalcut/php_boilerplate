<?php
	
	namespace marshall\plugins\ldap\services;
	use \F3 as F3;
	use \adLDAP as adLDAP;
	use marshall\core\Error as Error;

	class LdapService {
		private $ldapSettings;
		private $adldap;

		public function __construct($args){
			$this->ldapSettings = $args;
			$sll_options = array(
				"account_suffix"=>$args["accountSuffix"],
				"use_tls"=>$args["useTLS"],
				"base_dn"=>$args["baseDN"],
				"domain_controllers"=>explode(",",$args["domainControllers"])
				);

			$this->adldap = new adLDAP($sll_options);

		}



		function authenticate($username, $password, $adminOnly) {
			if ( empty($username) || empty($password) ) {
				/*
				$error = new WP_Error();

				if ( empty($username) )
					$error->add('empty_username', __('<strong>ERROR</strong>: The username field is empty.'));

				if ( empty($password) )
					$error->add('empty_password', __('<strong>ERROR</strong>: The password field is empty.'));

				return $error;
				*/
			}
			
			$auth_result = $this->can_authenticate($username, $password);
			$is_admin = false;
			if($auth_result && strLen($this->ldapSettings["adminGroups"])){
				$is_admin = $this->is_in_admin_group($username);
				if($adminOnly){
					$auth_result = false;
				}
			}

			return $auth_result;

		}
		function can_authenticate($username, $password){
			$result = $this->adldap->authenticate($username,$password);

			if($result == false)
			{ 
				return new Error('ldap_error', '<strong>Simple LDAP Login Error</strong>: LDAP may have errored. ', $this->adldap->get_last_error());
			}
			return $result;
		}
		function is_in_admin_group($username){
			return $this->adldap->user_ingroup($username, explode(",", $this->ldapSettings["adminGroups"]));
		}
	}
?>
