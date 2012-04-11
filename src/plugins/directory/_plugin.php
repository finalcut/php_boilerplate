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

			$node = new MenuItem();
			$node->name = $this->name;
			$node->root_path = '/directory';
			$node->icon = 'icon-user';
			$node->sort_order = 50;

			Menu::addMenu($node);

		}


	}
?>