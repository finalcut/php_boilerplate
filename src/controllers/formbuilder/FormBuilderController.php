<?php
	namespace php_boilerplate\controllers\formbuilder;
	use \F3 as F3;
	use \Template as Template;

	class FormBuilderController extends \marshall\controllers\BaseController {
		function home(){
			F3::set('html_title', 'Form Builder');
			F3::set('content','formbuilder/home.html');
			$this->addScript('formbuilder/formbuilder.js');
			echo Template::serve('layout/site.html');
		}
	}
?>