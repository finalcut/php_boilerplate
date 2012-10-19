<?php
	
	namespace php_boilerplate\plugins\home;
	use \marshall\core\Menu as Menu;
	use \marshall\core\MenuItem as MenuItem;

	class _plugin extends \marshall\core\BasePlugin {
		private $name = "Home";

		public function getPluginName(){
			return $this->name;
		}

		public function addMenuItems(){
			$node = $this->buildMenuItem($this->name, "/", 'icon-home', 10);
			Menu::addMenu($node);

		}


	}
?>