<?php

function gcd(){
	return basename(dirname(__FILE__));
}



function writeIt($file,$it){
	$fh = fopen($file, 'w') or die("can't open file $file");
	fwrite($fh, $it);
	fclose($fh);
}

function writeGitIgnore($thisDir){
$ig = <<<EOD
*.tpl.*
*.DS_Store*
cache.properties
build		
EOD;


	if($thisDir == "php_boilerplate"){
		$ig .= "f3" . "\n";
		$ig .= "src/config.cfg" . "\n";
		$ig .= "src/.htaccess" . "\n";
	}


	writeIt(".gitignore",$ig);


}


function promptUser($question,$default){
	echo $question;
	$fh = fopen("php://stdin","r");
	$reply = fgets($fh);
	if(trim($reply)==''){
		$reply = $default;
	}
	fclose($fh);
	return $reply;
}


function writeHtAccess($thisDir){
	$rules =  <<<EOD
RewriteEngine On
RewriteBase /$thisDir/src
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . index.php [L]
EOD;

	writeIt("src/.htaccess",$rules);

}


function confirmTrueOrFalse($val){
		$val = trim(strtolower($val));
		return ($val == "true" ? "true" : $val == "t" ? "true" : $val == "yes" ? "true" : $val == "y" ? "true" : "false");

}


function writeConfig($thisDir){


	$intro = <<<EOD


		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		The following questions will help setup your applications configuration.
		Don't worry!  You can change your configuration at any time by editing
		the src/config.cfg file.  The default for each answer is highlighted
		inside parentheses.
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


EOD;
	echo $intro;

	$projectName = promptUser("What is the project name? ($thisDir)", $thisDir);

	$jsValidation = promptUser("Do you want to use Javascript Form Validation (TRUE/false)?", "true");

	$jsValidation = confirmTrueOrFalse($jsValidation);

	$jsMasking = promptUser("Do you want to use Javascript Form Field Masks? (TRUE/false)?", "true");
	$jsMasking = confirmTrueOrFalse($jsMasking);

	$backbone = promptUser("Do you want to use the Backbone Javascript MVC framework? (true/FALSE)?", "false");
	$backbone = confirmTrueOrFalse($backbone);

	$feedback = promptUser("Do you want to use the feedback tool? (true/FALSE)", "false");
	$feedback = confirmTrueOrFalse($feedback);




	$config = <<<EOD
[globals]
;
; F3 STANDARD SETTINGS
;

CACHE=false
DEBUG=3
UI=plugins/



;-------- APPLICATION SPECIFIC SETTINGS

siteroot=/$thisDir

;--- The application isn't in the root of the webserver is it?   If not then provide the path, relative to the root, here.

relroot=/$thisDir/src


;--- WHERE OH WHERE is BOOTSTRAP?  IT should have a js and css directory in it.. otherwise things will look very very bad

bootstraphome=/bootstrap  


;--- you probably don't need to change this.. but if you put your controllers somewhere wierd; change this:

controllers=controllers/
routes=plugins/


;--- this isn't really important but if all else fails the header will try to use this as your <title> value.

projectname=$projectName


;--- you can optionally use form field masking automatically throughout the app... just set this to true:

useJSFormFieldMasking=$jsMasking

;--- you can turn on javascript form validation (using jquery validation plugin) just set this to true:

useJSFormValidation=$jsValidation


; --- you can turn on the mu standard feedback tool; just set this to true.  Make sure the tool works first; check muwww03/e$/inetpub/php_apps/mufeedback and make sure submission.php is finished.
useFeedbackTool=$feedback


;--- you can use backbone if you want; just set this to true:

useBackbone=$backbone


;--- you can use AjaxCRUD if you want; just set this to true:
dbsettings.type=mysql
dbsettings.host={YOURDBHOST}
dbsettings.name={YOURDBNAME}
dbsettings.username={YOURDBUSERNAME}
dbsettings.password= {YOURDBPASSWORD}
EOD;

	writeIt("src/config.cfg",$config);


}


function getF3(){

	if(!is_dir('f3')){ // only grab if we don't have it already

	$intro = <<<EOD


		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		Attempting to get the latest version of F3 from the git repository
		if you are prompted for a password please enter the password you assigned
		to your private key.
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


EOD;
	echo $intro;




		exec('git clone git://git@github.com:bcosca/Fat-Free-Framework.git f3');
	}


}


if(defined('STDIN')){ // only execute if running from the CLI
	$thisDir = gcd();

	getF3();

	writeHtAccess($thisDir);

	writeConfig($thisDir);

	if(is_dir('src/temp')){
		exec('chmod 777 src/temp');
	}

	launchBrowser($thisDir);

	$bye = <<<EOD


		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		Your application is all setup!

		A webbrowser should have opended to http://localhost/$thisDir/src to get you started.

		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


EOD;

	echo $bye;
}


function launchBrowser($thisDir){
	$os = php_uname('s');
	$cmd = $os == 'Darwin' ? 'open' : 'start';
	$foo = exec ("$cmd http://localhost/$thisDir/src");
}


