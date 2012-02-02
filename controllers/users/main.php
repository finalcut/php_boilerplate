<?php

	// handles calls directly to the users subdirectory..
	F3::route('GET /users',
		function() {
			F3::set('html_title', 'Become a User');
			F3::set('content','users/signup.html');
			echo Template::serve('layout.html');
		});


?>