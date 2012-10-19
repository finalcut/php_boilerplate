<?php
	/*
		basic controller class.  All other controller classes SHOULD extend this class as it provides some useful helper methods
		that each controller will probably need.
	*/ 
	namespace marshall\core;
	use \marshall\core\Base as Base;

	abstract class BasePlugin extends Base {
		/*
			 if you override the constructor in your class; please make sure you call this one too. ex:
			 parent::NonPersistentBean();
		*/
		function __construct(){
			$this->addMenuItems();
		}
		 
		abstract function addMenuItems();

		abstract function getPluginName();

		function buildMenuItem($name, $path, $icon, $sort_order, $id=""){
			$item = new MenuItem();
			$item->name = $name;
			$item->root_path = $path;
			$item->icon = $icon;
			$item->sort_order = $sort_order;
			$item->id = $id;
			return $item;

		}


	}
?>