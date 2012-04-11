<?php
	namespace php_boilerplate\plugins\formbuilder;
	use \F3 as F3;
	use \Template as Template;

	class FormBuilder extends \marshall\core\BaseController {
		function home(){
			F3::set('html_title', 'Form Builder');
			F3::set('content','formbuilder/views/home.html');
			$this->addScript('formbuilder/views/formbuilder.js');
			echo Template::serve('core/layout/site.html');
		}
	}
?>