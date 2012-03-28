<?php
	namespace php_boilerplate\controllers\other;
	use \F3 as F3;
	use \Template as Template;

	class OtherController extends \php_boilerplate\controllers\BaseController {
		function foo(){
			F3::set('html_title', 'Bar');
			F3::set('content','foo, bar, and extra are all the same page at the moment..');
			echo Template::serve('layout/site.html');
		}
	}
?>