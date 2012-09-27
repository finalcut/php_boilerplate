<?php
	/*
		basic controller class.  All other controller classes SHOULD extend this class as it provides some useful helper methods
		that each controller will probably need.
	*/ 
	namespace marshall\core;
	use \F3 as F3;

	abstract class Base {

		/* if you need to include one or more script files in your site pass them into this funciton.
		the scripts will be added to the bottom of the site (for faster page load) and will also be included AFTER 
		jquery and bootstrap so that all of the methods within those scripts are available to your scripts.

		Scripts will be made available in the order they are added to this function.  Check /views/layout/footer.html to
		see how they are included.
		*/
		function addScript($scriptFile){
			$this->addScriptFile($scriptFile,"scripts");
		}


		/*
			if you need to include one ore more javascript files in yoru site but you want to use F3 variables within those javascript
			files then use this function.  This file will be rendered on the server before being returned.  It basically works just like
			addScript above.  

			NOTE:  rendered scripts are returned before non-rendered scripts and in the order they are added to this function
			see /views/layout/footer.html 
		*/
		function addf3Script($scriptFile){
			$this->addScriptFile($scriptFile,"f3scripts");
		}

		private function addScriptFile($scriptFile, $key){
			$scripts = F3::get($key);
			array_push($scripts,$scriptFile);
			F3::set($key, $scripts);
		}


		function addPostRouteCallback($callback){
			$callbacks = F3::get("callbacks");

			$callbacks = is_array($callbacks) ? $callbacks : array();

			array_push($callbacks,$callback);
			F3::set("callbacks",$callbacks);
		}

		function runPostRouteCallbacks(){
			$callbacks = F3::get("callbacks");
			if(is_array($callbacks)){
				foreach($callbacks as $callback){
					try{
						call_user_func($callback);
					} catch(Exception $e){ 
						// don't do anything..
					}
				}
			}
		}



		function dump($val){
			print_r("<pre>");
			print_r($val);
			print_r("</pre>");
		}

	}
?>