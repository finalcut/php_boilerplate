<?php
	require_once 'controllers/BaseController.php';

	class FormBuilderController extends BaseController {
		function home(){
			F3::set('html_title', 'Form Builder');
			F3::set('content','formbuilder/home.html');
			$this->addScript('formbuilder/formbuilder.js');
			echo Template::serve('layout/site.html');
		}
	}
?>