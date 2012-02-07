<?php
	/*
		basic controller class.  All other controller classes SHOULD extend this class as it provides some useful helper methods
		that each controller will probably need.
	*/ 
	class BaseController {



		/* if you need to include one or more script files in your site pass them into this funciton.
		the scripts will be added to the bottom of the site (for faster page load) and will also be included AFTER 
		jquery and bootstrap so that all of the methods within those scripts are available to your scripts.

		Scripts will be made available in the order they are added to this function.  Check /views/layout/footer.html to
		see how they are included.
		*/
		function addScript($scriptFile){
			$scripts = F3::get('scripts');
			array_push($scripts,$scriptFile);
			F3::set('scripts', $scripts);
		}
	}
?>