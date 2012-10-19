<?php
	namespace marshall\core;
	use \F3 as F3;
	use \Axon as Axon;
	use \DB as DB;
	use \marshall\core\Base as Base;

	class BaseDAO extends Base {

		function setupSQLDB(){
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