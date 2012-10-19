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

		/**
		 * attempts to authenticate a user against the LDAP server
		 * @param  string $username the ldap username
		 * @param  string $password the ldap password for $username
		 * @param  string $group    comma delimeted list of groups the user must be in in order to authenticate; can be an empty string meaning groups don't matter
		 * @return boolean          true if the user meets the criteria of having a valid username, password and is in any applicable groups; otherwise false;
		 */
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

		/**
		 * checks to make sure the user actually exists in the ldap directory with the password specified
		 * @param  string $username the ldap username
		 * @param  string $password the ldap password
		 * @return boolean           technically this returns either TRUE or an Error object with details about why they couldn't authenticate.
		 */
		function canAuthenticate($username, $password){
			$result = $this->adldap->authenticate($username,$password);

			if($result == false)
			{ 
				return new Error('ldap_error', '<strong>Simple LDAP Login Error</strong>: LDAP may have errored. ', $this->adldap->get_last_error());
			}
			return $result;
		}
		
		/**
		 * checks to see if the user given by $username is in one of the groups in $groups
		 * @param  string  $username the ldap username
		 * @param  string  $groups   comma delimeted list of group strings
		 * @return boolean           returns true if the user is in ANY of the groups, false otherwise
		 */
		function isInGroup($username, $groups){
			$groups = explode(",", $groups);
			foreach($groups as $group){
				if($this->adldap->user_ingroup($username, $group)){
					return true;
				}
			}
			return false;
		}

		/**
		 * fetches an array of details from the ldap server.  Will return a blank value for any detail that can not be found
		 * some example details you can request:   'sn' will return the surname (lastname) and 'givenanme' will return the firstname.
		 * sample usage:  
		 * $deets = $ldapService->getUsersDetails($data["username"], array("givenname", "sn"));
		 * also you can pass in array('*') to get back all available details like so
		 * $deets = $ldapService->getUsersDetails($data["username"], array("*"));
		 * that's useful if you aren't sure what details you can pull back.
		 *
		 * @param  string  $username the ldap username that you want the details for.
		 * @param  array   $fields   an array of the fields you want returned; see functional description for more details.
		 * @param  boolean $dump     will dump out the fields returned from the ldap server and call die() so you can evaluate the structure.  defaults to false
		 * @return array             a simple key/value array where the keys are the fields you asked for and the values are either what was returned or an empty string
		 *                           	if no value was found for that argument.
		 * 
		 */
		function getUsersDetails($username, $fields, $dump=false){

			// force $fields to this to pull back everything and see what the options are if you aren't sure.
			//$fields = array("*");
			//
			//sn == surname or lastname
			//givenname = firstname
			$deets = $this->adldap->user_info($username, $fields );
			$details;
			foreach($fields as $field ){
				if(isset($deets[0][$field])){
					$details[$field] = $deets[0][$field][0];
				} else {
					$details[$field] = "";
				}
			}
			return $details;
		}		
	}
?>
