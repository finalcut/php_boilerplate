<?php

	// register the plugin:
	$plugin = new \marshall\plugins\ldap\_plugin();

	F3::route('GET /logout', 'marshall\plugins\ldap\LDAPController->logout');
	F3::route('GET /loginForm', 'marshall\plugins\ldap\LDAPController->loginForm');
	F3::route('POST /login', 'marshall\plugins\ldap\LDAPController->tryLogin');
?>