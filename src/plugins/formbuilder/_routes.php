<?php

	// register the plugin:
	$plugin = new \php_boilerplate\plugins\formbuilder\_plugin();

	// define the plugin routes
	F3::route('GET /formbuilder', '\php_boilerplate\plugins\formbuilder\FormBuilder->home');

?>