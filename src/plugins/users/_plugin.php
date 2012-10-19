<?php
	
	namespace php_boilerplate\plugins\users;
	use \marshall\core\Menu as Menu;
	use \marshall\core\MenuItem as MenuItem;

	class _plugin extends \marshall\core\BasePlugin {
		private $name = "Users";

		public function getPluginName(){
			return $this->name;
		}

		public function addMenuItems(){
			$node = $this->buildMenuItem($this->name, "/users", 'icon-user', 30);
			Menu::addMenu($node);

		}


	}
?>