<?php
	use \marshall\core\Session as Session;
	use \marshall\core\BaseUser as BaseUser;


	$session = new Session();

	if(!$session->get("USER")){
		$user = new BaseUser();
		$session->set("USER", $user);
	}

?>