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

			$node = new MenuItem();
			$node->name = $this->name;
			$node->root_path = '/users';
			$node->icon = 'icon-user';
			$node->sort_order = 30;

			Menu::addMenu($node);

		}


	}
?>