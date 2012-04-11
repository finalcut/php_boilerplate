<?php

	// register the plugin:
	$plugin = new \php_boilerplate\plugins\other\_plugin();

	// define the plugin routes
	F3::route('GET /other/@thisPage', '\php_boilerplate\plugins\other\Other->foo');
?>