<?php
	
	namespace php_boilerplate\plugins\formbuilder;
	use \marshall\core\Menu as Menu;
	use \marshall\core\MenuItem as MenuItem;

	class _plugin extends \marshall\core\BasePlugin {
		private $name = "Form Builder";

		public function getPluginName(){
			return $this->name;
		}

		public function addMenuItems(){

			$node = new MenuItem();
			$node->name = $this->name;
			$node->root_path = '/formbuilder';
			$node->icon = 'icon-check';
			$node->sort_order = 20;

			Menu::addMenu($node);

		}


	}
?>