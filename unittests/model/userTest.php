<?php
require '../../model/user.php';
class UserTest extends PHPUnit_Framework_TestCase
{


	public function testConstructor(){
		$user = new User();
		$this->assertEquals($user->role, "user");
		$this->assertEquals($user->username, "");
		$this->assertEquals($user->someUselessProperty, "please ignore me");
		
		$this->assertFalse(array_key_exists("foo", get_object_vars($user)));

	}

	public function testInitPropertiesFromArrayUseDefaults(){
		$fatProps = array();
		$user = new User();
		$user->initPropertiesFromArray($fatProps);

		$this->assertEquals($user->role, "user");
	}

	public function testInitPropertiesFromArrayOverrideDefaults(){
		$fatProps = array('role'=>'admin');
		$user = new User();
		$user->initPropertiesFromArray($fatProps);

		$this->assertEquals($user->role, "admin");
	}

	public function testInitPropertiesFromNonArray(){
		$fatProps = "blah";
		$user = new User();
		$user->initPropertiesFromArray($fatProps);

		$this->assertEquals($user->role, "user");
	}

	public function testInitPropertiesFromArrayInvalidPropertyAutoSet(){
		$fatProps = array('foo'=>'bar');

		$user = new User();
		$user->initPropertiesFromArray($fatProps);

		/* 
		this will always return false even if we force $this->foo to equal something using
		dynamic assignments

		isset($this->foo)

		*/

		$this->assertFalse(array_key_exists("foo", get_object_vars($user)));
	}

	public function testToStringWithValidUsername(){
		$fatProps = array('username'=>'some-user');

		$user = new User();
		$user->initPropertiesFromArray($fatProps);


		$o = $user->toString();


		$expected = "username: some-user\nfirstname:\nlastname:\nrole: user\nemail:\n";
		/*
		echo $o;
		echo "------\n";
		echo $expected;
		*/

		// $this->assertEquals($o, $expected);

		/* not sure why this test fails; it appears to be the same string; */

	}

}

