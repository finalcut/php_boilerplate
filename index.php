<?php
 
require '../f3/lib/base.php';
 
F3::config('config.cfg');


 	// standard controller actions (homepage, 404, etc)
 	include('controllers/main.php');

	// each subsystem within the application should have it's own controller; include them here.
	// for instance if you have a users section you would include it like so; look in the controllers directory to // see how the controllers are put together.
	include('controllers/users/main.php');

	

F3::run();
 
?>