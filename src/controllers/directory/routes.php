<?php
	require 'DirectoryController.php';
	// handles calls directly to the users subdirectory..

	F3::route('GET /Directory', 'DirectoryController->home');
	F3::route('Get /Directory/Listing', 'DirectoryController->listing');

	/* 	note these three all capture anything after their root directoy as "@resource"
	 	that is then stored in PARAMS['resource'] and is used within the controller.
	 	see the loadresource function
	 */
	F3::route('Get /Directory/Template/@resource', 'DirectoryController->template');
	F3::route('Get /Directory/js/views/@resource', 'DirectoryController->jsview');
	F3::route('Get /Directory/js/models/@resource', 'DirectoryController->model');
?>