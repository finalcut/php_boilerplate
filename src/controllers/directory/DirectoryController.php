<?php
	
	namespace php_boilerplate\controllers\directory;

	class DirectoryController extends \php_boilerplate\controllers\BaseController {

		/*
			This section is a little unusual in that it uses some AJAX features via backbone
			and javascript templating via underscore.

			listing, template, jsview, and model are all sort of special in that they just use the loadresource
			function to render their stuff; each just passes a path to the view to be rendered into the function.

			Obviously these are all very trivial in that there is only one view related to each action and there are no
			subviews perse.
		*/


		/*
			this is an illustration of using both rendered js script files and plain js script files.
			renderd files can reference F3 attributes/varibles within them while plain ones can't.
		*/
		function home(){
			\F3::set('html_title', 'Employee Directory');

			/* this really is special; the content for home is provided by the later js file "directory/js/views/home.js" - which actuall
			 loads directory/tpl/home.html  - it is a little confusing at first but it works out pretty well.  I really don't even have to set
			 content to empty here other than to illustrate what is going on.
			*/
			\F3::set('content','');

			//plain JS file
			$this->addScript('directory/js/utils.js');


			// rendered JS files
			$this->addF3Script('directory/js/models/employeemodel.js');
			$this->addF3Script('directory/js/views/home.js');
			$this->addF3Script('directory/js/views/employeelist.js');

			// plain JS file
			$this->addScript('directory/js/main.js');

			echo \Template::serve('layout/site.html');
		}

		function listing(){
			// it is important when returning a JSON object that you write the JSON headers or jquery may not process the return properly
			$this->writeJsonHeaders();

			$this->loadresource('/json/listing.html','');
		}


		/*
			 any template files being loaded via AJAX requests will be returned this way.
			 and yes, to answer the unspoken question, this means there are two round trips alone just to show then
			 home page content..

			 The initial homepage content doesn't need to be loaded this way; but once we enter the client side MVC it is best to be consistent..
		*/
		function template(){
			$this->writeJavascriptHeaders();

			$this->loadresource('/tpl/', '.html');
		}

		/*
			any javascript view files being used for this subdirectory will be returned via this method..
		*/
		function jsview(){
			$this->writeJavascriptHeaders();

			$this->loadresource( '/js/views/','');
		}


		/*
			any model objects?  they are returned this way..
			honestly, you would probably want to figure out a way to minimize all of your apps javascript when your done so that there aren't so many 
			round trips
		*/
		function model(){
			$this->writeJavascriptHeaders();

			$this->loadresource('/js/models/','');
		}


		/*
			if the resource param isn't provided in the calling url an empty string is put there; for example
			when /directory/listing is called there is no resouce being found (see routes.php in this directory to see how resource is assigned)
			however the listing function in this file can still call this becuase it basically hardcodes the resource value in the path variable as listing.html
		*/
		private function loadresource($path, $ext){
			\F3::set('content','directory' . $path . \F3::get('PARAMS["resource"]') . $ext);
				echo \Template::serve('layout/bare.html');
			
		}


	}
?>