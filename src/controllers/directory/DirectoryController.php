<?php
	require_once 'controllers/BaseController.php';

	class DirectoryController extends BaseController {
		function home(){
			F3::set('html_title', 'Employee Directory');
			F3::set('content','');
			$this->addScript('directory/js/utils.js');

			$this->addF3Script('directory/js/models/employeemodel.js');
			$this->addF3Script('directory/js/views/home.js');
			$this->addF3Script('directory/js/views/employeelist.js');

			$this->addScript('directory/js/main.js');
			echo Template::serve('layout/site.html');
		}

		function listing(){
			$this->writeJsonHeaders();

			$this->loadresource('/json/listing.html','');
			//F3::set('content','directory/json/listing.html');
			//echo F3::render('layout/json.html');
		}

		function template(){
			$this->writeJavascriptHeaders();

			$this->loadresource('/tpl/', '.html');
		}
		function jsview(){
			$this->writeJavascriptHeaders();

			$this->loadresource( '/js/views/','');
		}


		function model(){
			$this->writeJavascriptHeaders();

			$this->loadresource('/js/models/','');
		}


		function loadresource($path, $ext){
			F3::set('content','directory' . $path . F3::get('PARAMS["resource"]') . $ext);
				echo Template::serve('layout/bare.html');
			
		}


	}
?>