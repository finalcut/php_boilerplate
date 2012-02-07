<?php
 
require_once '../f3/lib/base.php';
 
F3::config('config.cfg');

F3::set('scripts', array());


 	// standard controller actions (homepage, 404, etc)
 	include('controllers/routes.php');

	// each subsystem within the application should have it's own controller; include them here.
	// for instance if you have a users section you would include it like so; look in the controllers directory to // see how the controllers are put together.
	include('controllers/users/routes.php');


	//this shows a dynamic router..
	include('controllers/other/routes.php');


	//form builder utility
	include('controllers/formbuilder/routes.php');


	// at this point, if no html_title value was set; we will try to set one!
	$title = F3::get("html_title") == null
					? (  F3::get("projectname") == null ? "No ProjectName or Html_Title provided" : F3::get("projectname") ) 
					: F3::get("html_title");

	F3::set("html_title", $title);



F3::run();
 


?>