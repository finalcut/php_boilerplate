<?php
	
	namespace php_boilerplate\plugins\other;
	use \marshall\core\Menu as Menu;
	use \marshall\core\MenuItem as MenuItem;

	class _plugin extends \marshall\core\BasePlugin {
		private $name = "Other Links";

		public function getPluginName(){
			return $this->name;
		}

		public function addMenuItems(){
			$node = $this->buildMenuItem($this->name, "/other", 'icon-chevron-right', 40);
			$node->addMenuItem($this->buildMenuItem("Foo", "/other/foo", '', 10));
			$node->addMenuItem($this->buildMenuItem("Bar", "/other/bar", '', 20));
			$node->addMenuItem($this->buildMenuItem("Extra", "/other/extra", '', 30));
			Menu::addMenu($node);
		}


	}
?>