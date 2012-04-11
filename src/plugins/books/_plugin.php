<?php
	
	namespace php_boilerplate\plugins\books;
	use \marshall\core\Menu as Menu;
	use \marshall\core\MenuItem as MenuItem;

	class _plugin extends \marshall\core\BasePlugin {
		private $name = "Books";

		public function getPluginName(){
			return $this->name;
		}

		public function addMenuItems(){

			$node = new MenuItem();
			$node->name = $this->name;
			$node->root_path = '/books';
			$node->icon = 'icon-book';
			$node->sort_order = 60;

			Menu::addMenu($node);

		}


	}
?>