<?php
	require_once 'controllers/BaseController.php';

	class OtherController extends BaseController {
		function foo(){
			F3::set('html_title', 'Bar');
			F3::set('content','foo, bar, and extra are all the same page at the moment..');
			echo Template::serve('layout/site.html');
		}
	}
?>