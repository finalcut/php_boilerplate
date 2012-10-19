<?php
	
	namespace php_boilerplate\plugins\directory;
	use \marshall\core\Menu as Menu;
	use \marshall\core\MenuItem as MenuItem;

	class _plugin extends \marshall\core\BasePlugin {
		private $name = "Employee Directory";

		public function getPluginName(){
			return $this->name;
		}

		public function addMenuItems(){
			$node = $this->buildMenuItem($this->name, "/directory", 'icon-user', 50);
			Menu::addMenu($node);

		}


	}
?>