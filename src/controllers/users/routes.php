<?php
	require 'UsersController.php';
	// handles calls directly to the users subdirectory..


	F3::route('GET /users', 'UsersController->home');


?>