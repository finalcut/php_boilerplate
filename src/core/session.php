<?php
	namespace marshall\core;
	
	use \marshall\core\Base as Base;
	use \F3 as F3;

		class Session extends Base {

			public function get($key){
					$key = F3::get("projectname") . $key; 
					if(isset($_SESSION)){
						if(isset($_SESSION[$key])){
							return unserialize($_SESSION[$key]);
						} else {
							return false;
						}

					} else {
						die("you must use session_start to turn on sessions at the top of the entry page.");
					}

			}

			public function set($key, $value){
					$key = F3::get("projectname") . $key; 
				
					if(isset($_SESSION)){
						return $_SESSION[$key] = serialize($value);
					} else {
						die("you must use session_start to turn on sessions at the top of the entry page.");
					}
			}

		}
?>