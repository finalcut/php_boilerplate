<?php
	require 'OtherController.php';
	// handles calls directly to the users subdirectory..


	F3::route('GET /other/*', 'OtherController->foo');


?>