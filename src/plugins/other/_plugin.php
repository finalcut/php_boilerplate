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

			$node = new MenuItem();
			$node->name = $this->name;
			$node->root_path = '/other';
			$node->icon = 'icon-chevorn-right';
			$node->sort_order = 40;


			$child1 = new MenuItem();
			$child1->name = "Foo";
			$child1->root_path = '/other/foo';
			$child1->icon = '';
			$child1->sort_order = 10;

			$node->addMenuItem($child1);

			$child2 = new MenuItem();
			$child2->name = "Bar";
			$child2->root_path = '/other/bar';
			$child2->icon = '';
			$child2->sort_order = 20;

			$node->addMenuItem($child2);

			$child3 = new MenuItem();
			$child3->name = "Extra";
			$child3->root_path = '/other/extra';
			$child3->icon = '';
			$child3->sort_order = 30;

			$node->addMenuItem($child3);


			Menu::addMenu($node);

		}


	}
?>