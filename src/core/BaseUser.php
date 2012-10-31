<?php
	/*
		represents a basic Marshall University user.; feel free to extend it if you need additional properties..
	*/ 
	namespace marshall\core;
	use \marshall\core\Base as Base;

	class BaseUser extends Base {
		private $username = "";
		private $loggedIn = false;
		private $isAdmin = false;
		private $id = 0;
		
		function __construct(){
			$this->clearAll();
		}

		public function clearAll(){
			$this->setUsername("");
			$this->setLoggedIn(false);
			$this->setIsAdmin(false);
			$this->setId(0);
		}

		public function setUsername($username){
			$this->username = $username;
		}
		public function username(){
			return $this->username;
		}

		/**
		 * set a flag about whether the current user is logged in.
		 * @param bool $loggedIn 
		 */
		public function setLoggedIn($loggedIn){
			$this->loggedIn = $loggedIn;
		}

		/**
		 * tells you if the current user is logged in.
		 * @return boolean
		 */
		public function isLoggedIn(){
			return $this->loggedIn;
		}

		public function setIsAdmin($isAdmin){
			$this->isAdmin = $isAdmin;
		}

		public function isAdmin(){
			return $this->isAdmin;
		}


		public function setId($id){
			$this->id = $id;
		}
		public function getId(){
			return $this->id;
		}
	}
?>