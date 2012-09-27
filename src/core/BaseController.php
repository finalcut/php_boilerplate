<?php
	/*
		basic controller class.  All other controller classes SHOULD extend this class as it provides some useful helper methods
		that each controller will probably need.
	*/ 
	namespace marshall\core;
	use \F3 as F3;
	use \Template as Template;
	use \marshall\core\Session as Session;
	use \marshall\core\Base as Base;

	class BaseController extends Base {
		public $session;

		public function __construct(){
			$this->session = new Session();
		}

		function beforeRoute(){
			// gets executed before the current route..
		}

		function afterRoute(){
			// gets executed after the current route..; make sure you call parent::afterRoute(); if you override this method!
			$this->runPostRouteCallbacks();
		}

		// basically makes it so the content returned can't be cached since it is already outdated.
		function writeNoCacheHeaders(){
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		}

		// tells the browser what is coming back is json and not html
		function writeJsonHeaders(){
			$this->writeNoCacheHeaders();
			header('Content-type: application/json');
		}

		// tells the browser what is coming back is javascript..
		function writeJavascriptHeaders(){
			$this->writeNoCacheHeaders();
			header('Content-type: text/javascript');
		}

	}
?>