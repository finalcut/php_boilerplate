<?php
	namespace php_boilerplate\plugins\other;
	use \F3 as F3;
	use \Template as Template;

	class Other extends \marshall\core\BaseController {
		function foo(){
			F3::set('html_title', F3::get('PARAMS["thisPage"]'));
			F3::set('thisPage', F3::get('PARAMS["thisPage"]'));
			F3::set('content','other/views/other.html');
			echo Template::serve('core/layout/site.html');
		}
	}
?>