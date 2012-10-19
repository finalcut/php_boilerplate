<?php
	namespace marshall\core;
	use \F3 as F3;
	use \Axon as Axon;
	use \DB as DB;
	use \marshall\core\Base as Base;

	class BaseDAO extends Base {
		public function __construct(){
			$this->setupDB();
		}
		function setupDB(){
			switch(strtolower(F3::get("dbsettings.type"))){
				case "mysql":
					$this->setupMySQLDB();
					break;
				default:
					$this->setupMySQLDB();
					break;
			}
		}

		function setupMySQLDB(){
			$connString =  "mysql:host=" . F3::get("dbsettings.host") . ";port=3306;dbname=" . F3::get("dbsettings.name");

			F3::set('DB',
				new DB(
					$connString,
					F3::get("dbsettings.username"),
					F3::get("dbsettings.password")
				)
			);

		}


	}
?>