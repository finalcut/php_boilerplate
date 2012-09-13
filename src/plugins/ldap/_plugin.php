<?php
	
	namespace marshall\plugins\ldap;
	use \marshall\core\Menu as Menu;
	use \marshall\core\MenuItem as MenuItem;
	use \marshall\core\Session as Session;
	use \F3 as F3;

	class _plugin extends \marshall\core\BasePlugin {
		private $name = "LDAP";
		private $session;

		public function __construct(){
			$this->session = new Session();


			parent::__construct();
		}


		public function getPluginName(){
			return $this->name;
		}

		public function addMenuItems(){
			$isLoggedIn = $this->session->get("isLoggedIn");

			$this->session->dump();
			
			$node = new MenuItem();

			if(!$isLoggedIn){			
				$node->name = "Login";
				$node->root_path = '/loginForm';
				$node->icon = 'icon-lock';
				$node->sort_order = 100;
			} else {
				$node->name = "Logout";
				$node->root_path = '/logout';
				$node->icon = 'icon-lock';
				$node->sort_order = 100;
			}

			Menu::addMenu($node);

		}


	}
?>