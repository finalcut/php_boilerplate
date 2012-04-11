<?php

	// register the plugin:
	$plugin = new \php_boilerplate\plugins\users\_plugin();

	// define the plugin routes
	F3::route('GET /users', '\php_boilerplate\plugins\users\Users->home');
?>