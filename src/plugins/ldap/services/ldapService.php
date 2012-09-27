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



		function authenticate($username, $password, $group) {
			if ( empty($username) || empty($password) ) {
				return new Error('ldap_error', 'username and password are both required');
			}
			
			$auth_result = $this->canAuthenticate($username, $password);
			$is_admin = false;
			if($auth_result && strLen($group)){
				$auth_result = $this->isInGroup($username);
			}

			return $auth_result;

		}
		function canAuthenticate($username, $password){
			$result = $this->adldap->authenticate($username,$password);

			if($result == false)
			{ 
				return new Error('ldap_error', '<strong>Simple LDAP Login Error</strong>: LDAP may have errored. ', $this->adldap->get_last_error());
			}
			return $result;
		}
		function isInGroup($username, $groups){
			$groups = explode(",", $groups);
			foreach($groups as $group){
				if($this->adldap->user_ingroup($username, $group)){
					return true;
				}
			}
			return false;
		}
	}
?>
