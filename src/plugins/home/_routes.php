<?php

	// register the plugin:
	$plugin = new \php_boilerplate\plugins\home\_plugin();



	F3::route('GET /',
		function() {
			// set the html_title variable if you want a page specific title.. If you don't then the value stored in the projectname configuration variable will be used as the page title.
			// look in config.cfg to see what the projectname is.   Here is an example of setting the html_title variable:
			// F3::set('html_title', 'PHP Boilerplate Application');
			

			F3::set('content','home/views/home.html');
			echo Template::serve('core/layout/site.html');
		});
?>