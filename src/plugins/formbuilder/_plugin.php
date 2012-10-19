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
			$node = $this->buildMenuItem($this->name, "/formbuilder", 'icon-check', 20);
			Menu::addMenu($node);

		}


	}
?>