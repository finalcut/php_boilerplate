<?php
	// register the plugin:
	$plugin = new \php_boilerplate\plugins\directory\_plugin();

	// define the plugin routes
	F3::route('GET /Directory', '\php_boilerplate\plugins\directory\Directory->home');
	F3::route('Get /Directory/Listing', '\php_boilerplate\plugins\directory\Directory->listing');

	/* 	note these three all capture anything after their root directoy as "@resource"
	 	that is then stored in PARAMS['resource'] and is used within the controller.
	 	see the loadresource function
	 */
	F3::route('Get /Directory/Template/@resource', '\php_boilerplate\plugins\directory\Directory->template');
	F3::route('Get /Directory/js/views/@resource', '\php_boilerplate\plugins\directory\Directory->jsview');
	F3::route('Get /Directory/js/models/@resource', '\php_boilerplate\plugins\directory\Directory->model');
?>