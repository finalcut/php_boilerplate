<?php
	require 'bean.php';
	class User extends NonPersistentBean
	{
		public $someUselessProperty = "ignore me";
		// example of how to create your own constructor while calling the parent constructor
		public function User(){
			$this->someUselessProperty = "please ignore me";
			parent::NonPersistentBean();
		}

		/* 
			all classes that extend bean must define this method.
			basically, instead of creating getters and setters for each property
			of the class and then having a constructor that sets the defaults this
			method must exist and it will happen automatically
		*/

		public function getDefaults(){
			return array(
				 'username'=>""
				,'firstname'=>""
				,'lastname'=>""
				,'role'=>"user"
				,'email'=>""
			);
		}
	}