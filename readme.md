# Introduction
This is "getting started" point for any PHP applications you might want to develop.   It uses the MVC (Model-View-Controller) pattern as provided by the [Fat Free Framework][f3].  The look and feel is dictated by [Twitter Bootstrap][bs].  Ideally it will be fairly easy to navigate around the project and to start developing your own functionality.  If you have any questions as you proceed (and after you've read this entire document) please email me at bill@rawlinson.us and I'll do my best to help you.

# What You Need
Before you can start developing with this you're going to need a few pre-requisites, such as bootstrap and some php libraries, and you'll need to know about a few key concepts such as [unit testing][phpunitHowTo], continuous integration.

## Prerequisites
I assume you already have PHP, PEAR, and a webserver installed as those steps are outside of the scope of this document.  You'll also need ANT installed and configured on your system. This means you need to havea  java SDK installed which, admittedly, sucks - but ANT is worth it so please bear with me.

### PHP Libraries
First and foremost you'll need to have a collection of PHP libraries installed on your development system.  These are all used to help enforce a certain level of code quality. The application you are developing is going to be deployed onto the shared production server so it is in all of our best interests to make sure the code you write is well tested before it is deployed.  The entire webserver could potentially be taken out of commission by one poorly crafted query.  You don't want someone else killing your application and they don't want you killing theirs.  Thus, by working within a common set of rules nand conventions we can help mitigate the chances of a server taken-down event.

1. Install Xdebug - http://xdebug.org/
1. Install PHP_CodeCoverage - https://github.com/sebastianbergmann/php-code-coverage
1. Install php-timer - https://github.com/sebastianbergmann/php-timer
1. Install PHPUNIT from https://github.com/sebastianbergmann/phpunit - the installation instructions are in that github's readme.
1. Install phploc -  https://github.com/sebastianbergmann/phploc
1. Install phpcpd - https://github.com/sebastianbergmann/phpcpd
1. Install php mess detector - http://phpmd.org/download/index.html
1. Install phpdepend - http://pdepend.org/documentation/getting-started.html
1. Install php-timer - https://github.com/sebastianbergmann/php-timer
1. Install php code sniffer - http://pear.php.net/package/PHP_CodeSniffer/download
1. install php code browser - http://blog.mayflower.de/archives/464-PHP_CodeBrowser-Release-version-0.1.0.html
1. install php dox - https://github.com/theseer/phpdox

It's possible that the versions of these tools have each increased since this document was released.  Install the most recent version available as it is most likely the most stable and most bug free.  Each of the links above has installation instructions with them.  For almost all (maybe all) of those tools you will be using the PEAR "php package manager"

You will also need to install the Autoload (phpab) library.  This is used to generate the "autoload.php" files found within the project.   Becuase the project utilizes object oriented design pricipals and makes use of PHP namespaces you need the functionality provided by the autoload.php files in order to make sure all of your php classes can reference each other when necessary.  There are also two helper files (autoload.sh and autoload.bat) that help make the creation of both autoload.php files a single step process.  Use the file that matches your development platform (.sh for mac/linux and .bat for windows).

1. install phpab (Autoload) - https://github.com/theseer/Autoload

While phpab isn't required (you can hand craft your autoload.php files) I really can't recommned it enough.  Using the tool will help avoid syntax errors or head-scratching scenarios where your code doesn't work becuase you forgot to include one of your many class file definitions in the autoload file.

#### Interlude : An Ode to Unit Testing
Once you have these tools installed you can begin to write [unit tests][phpunitHowTo].  If you're code is not unit tested it will NOT be permitted to be deployed into the production environment.  I strongly encourage you to become familiar with [Test Driven Development][http://en.wikipedia.org/wiki/Test-driven_development].  TDD will really make your life much easier in the long run.  When you first start it might seem hard but the more you do it the easier it gets and the more useful it becomes.  Further, TDD will help shorten your development time - even if you previously never wrote tests.  I know it sounds counter intuitive but it will becuase you're debugging processes will be much faster with TDD than without; plus with tests you will have a good idea if any future changes you make break some seemingly unrelated part of your application or not.

#### Web Libraries
Almost everything you need to actually get the boilerplate app working is included in the initial clone of the repository.  

You do need to have a way to reference an applicable copy of Twitter Boostrap.  I leave that as an exercise for you.

#### Second Interlude : Javascript Unit Testing
You should definitely be doing this.  However, because javascript problems will be isolated to harming the usability of your site only they are not required at the moment.  Our continuous integration server is not currently configured to provide   access to integration testing of javascript unit tests.  This may be added in the future and I strongly encourage you to look into the various JS Unit Testing frameworks.  You may also want to consider user interface testing with something like Selenium.  There is a selenium extension for FireFox that you can use to help create your UI tests.

__SERIOUSLY, UNIT TESTING IS GREAT__

# Code Organization
If this is your first time touching the project it might seem a little overwhelming.  Fear not!  It's not that bad and, in some places, you can just ignore some of the directories that are contained here.  Basically, within the project there are four top level directories:

* /build  - You'll never have to touch anything in /build.   The ANT build process uses the /build directory.  I'll explain ANT a little more later along with some details about the build file and the two phpunit.xml.* files.  
* /f3 - You'll never have to touch anything in /f3 - in fact DON'T touch anything in F3.  It is a framework we are using and any changes you make to it here won't be reflected in production so don't muck with F3
* /src - this is the actual project.  Anything in this directory is what will be deployed to production. Thus, if you have a web application anmed "Foo" then on the production server you should imagine Foo == /src.  There is more info on the /src directory later.
* /tests - My favorite directory. This is where your unit tests go.  The overall structure of this directory should mirror, pretty closely, the structure of /src - basically, any classes you have (excpet controllers) should have a matching unit test class that, well, tests your src/class file.

There are also some files in the root directory of the project.  This is what they each are for/do:
* .gitignore - this is used by git; basically you can use it to identify files you don't want to add to the git repository.
* .gitrepo - also used by git.  Basically has some meta data about the relevant git repository.  Don't worry about this file.
* autoload.bat - used to autogenerate the autoload.php files found in the /src and /tests directories.  Used on windows, run from the command line to see output.
* autoload.sh - identical to autoload.bat; but for mac and linux systems.   You need to chmod 755 this file; execute from the terminal `./autoload.sh`
* build.xml - this is used by ANT.  I'll go into this in more detail later.
* cache.properties - ?
* checkout.sh - if you have built a project and you want to create a copy that just has the /src directory you can use the checkout.sh file (only on mac/linux).
* init.php - use this before you do anything else; from the command line.  If you're on windows use the git command line.  Once there just run `php init.php` and it will prompt you with some questions about the project you're trying to setup.  Once done the project should be good to go.  This will set some defaults in the /src/config.cfg file and will make sure some other required directories exist and are ready to go for you.
* phpdox.xml.dist - this is used by the ant build process and the phpdox plugin you should have installed and mentioned up in the prerequisites.  You shouldn't have to muck with this file at all.
* phpunit.xml.dist - used by the ant build process via build.xml.  This basically says that all test files in the /tests directory should be executed.  Line 10 says that all test files will have a name with the pattern <something>Test.php  where something is the class under test.  If you prefer to use <something>Tests.php then make sure you change line 10 of this file; otherwise none of your tests will be seen and they won't be executed during the ant build process (or by the continuous integration server).
* phpunit.xml.single - If you want to run a set of unit tests on one file; and make sure they "autoload" stuff is run then you can use this xml file to help you out.  From the command line run `phpunit -c phpunit.xml.single {tests\path\to\test\file}` just replace the path with the correct path to your test file.

## It's All about /src
The /src directory is where your project actually lives.  There are some conventions to this directory and how it is organized.  Before you can really begin to modify what comes with the boilerplate app you'll need to understand these conventions and the organization of the code within.  Here is a brief overview of each of the directories:

* /cache  - this directory is used by the F3 (fat free framework) and only if you turn on caching in the config.cfg; make sure to chmod 777 if you use it and you're developing on a mac/linux machine.
* /core - these are some core components I am using across a variety of projects.  For the most part you shouldn't add things to this directory unless the class is generic enough to use in other projects that use the same structure/framework as this one. 
* /f3_utility - this is just something I use to autoload all of the routes into F3.
* /img - any images we are using.  I use twitter bootstrap and this is where I put the glyphicons.  I should probably just have this in the boostrap directory and let you use the ones that come with bootstrap.
* /lib - contains backbone-min.js and underscore-min.js; if you aren't going to use them you can delete them; just make sure you set usebackbone=false in config.cfg
* /plugins - See the section on PLUGINS later.  This is the directory you will spend 90% of your time.
* /temp - also used by F3 - this NEEDS to be there and needs to be CHMOD 777 - if you don't have this directory nothing will show up in the browser.
* .htaccess - required to get routing to work on a mac/linux and some IIS installs; identical in purpose to web.config which is used on other IIS installs; created using the init.php script; don't edit it.
* autoload.php - you should autogenerate this with phpab - https://github.com/theseer/Autoload - see all about phpab up in the prerequisites section.
* config.cfg - all of the configuration information you could ever want
* index.php - entry point to the application.  At most you should have to edit line 6 but you shouldn't have to edit this file at all. 
* web.config - required to get routing to work on some IIS installs.  Don't edit it.  Just trust in it.

### Really, It's all about /src/plugins
Each application developed with this framework should be modular; i.e. you will develop plugins to support different functional areas within the application.  Ideally, you should be able to remove a plugin without affecting the behavior of other plugins.  Avoid coupling between plugins (with the exception of the "core" plugin; you're plugin can and should expect certain items to exist in the core pluign).

The examples provided with the php_boilerplate are contrived and do not really represent much of a real world example of an application.  However, they each exist independently from the other plugins.  You can use each of these plugins to see how to use certain aspects of the framework.  For example, the directory plugin shows how to use bootstrap within the F3 MVC framework.

Each plugin must, by convention, define at least two files; _plugin.php and _routes.php.  

### _plugin.php
This file defines the plugin and is where you can define elements that will appear in the sitewide navigation.  Do not edit /plugins/core/layout/main_navigation.html by hand.  Define MenuItems and sub MenuItems within _plugin.php.  If you need submenu items refer to the "other" plugin provide with php_boilerplate to see an examle of defining a menu heirarchy.  Note: at the moment only two levels of menu heirarchy are supported within the main site navigation.

You're plugin should inheirit the core/BasePlugin class

### _routes.php
This file MUST exist.  If you don't have a _routes.php then you're plugin won't be picked up by the site.  Your _routes.php file serves two purposes.  First, and foremost, it instantiates your _plugin.php file.   Without doing this your _plugin file won't be seen by the framework and your navigation items won't appear in the main menu.  Secondly, but no less importantly, it defines what URLs your plugin listens on.  You need to make sure you aren't defining any urls that other plugins are listening on.  If you define a route that is already defined by another plugin you may break that other plugin OR your plugin won't work.  So double check you're routes.  Eventually I'll add a tool that automatically does this and throws an error if the same route is defined more than once.  You can learn more about how the [URL routing works via the F3 documentation](http://bcosca.github.com/fatfree/#routing-engine).   In the example code provided with this application I am using an object oriented approach to the "controller" files with the exception of the "home" and the "core" plugins where the routes are handled in a functional way.

I strongly suggest that you utilize the Object Oriented approach for your plugins.   Look at the formbuilder, directory, users, and other plugins for examples of how to do this.  Your controllers should inheirit the core/BaeController class.

Again, please remember that your _routes.php file must instantiate your _plugin.php class.  Like so:

```
	// register the plugin:
	$plugin = new \php_boilerplate\plugins\users\_plugin();
```

You should also organize your code in as logical of a manner as possible.  For intance keep your view files in a "views" directory within your plugin.  Feel free to use sub-directories within your views directory to further organize your files.  See the directory plugin for an example of further view organization.  Likewise, if you will be creating model objects you should put those in a model directory and service objects in a service directory; etc.  See the users plugin for an example of a model object.

# CRUD
The [F3][f3] provides some nice data acess libraries for doing basic Create,Read, Update, Delete (CRUD) operations.  Specifically, if you'll be accessing a relational database you can use the [Axon][axon] library.  Just note that joining across tables is clunky and sucks so if you want to do complex joins use a view and the have Axon read from the view.  You're welcome to roll your own data acess libraries but, for the most part, you'll probably get things done faster just using the ones that come with F3.

# Model Objects; ie - the Bean
I have a pretty strong background in Java so I tend to call model objects Beans.  However, I'm also kind of lazy and don't like writing all the boilerplate code that goes into defining traditional bean objects.  Thus there is a file in the /src/core directory called NonPersistentBean.php which gives you some nice functionality for rapidly creating a model object and providing getters/setters for the properties of that object.  If you need more complex getters and setters where you include logic within the getters or setters then you'll want to use a different pattern than that provided by the NonPersistentBean class.  You can look at the users plugin in /src/plugins/users/model to see an example of a class that builds on the NonPersistentBean base class.

The basic magic happens in via the getDefaults method:

```
		public function getDefaults(){
			return array(
				 'username'=>""
				,'firstname'=>""
				,'lastname'=>""
				,'role'=>"user"
				,'email'=>""
			);
		}
```

Basically this array maps a property (the key) to a default value (the value).  The value can be any type of object; in this example the objects just happen to be strings.  The ___construct method will initialize the properties with the values.  At any time you can then re-initialize your entire object by passing in a similarly structured array with the values you want to initialize the objects properties with.  If the array you pass in includes keys that are not defined in the "default" those properties will not be created or set; instead those keys in your array will be ignored.



# ANT
Ant is a build tool; if you're an old school C developer it's sort of like make but written in XML.   Ant is a Java thing but we can use it to interact with any kind of project really and thus we will be using it to "build" our php applications.  In this case build really means TEST.

Basically, after you've installed ANT (which requires a JAVA sdk to be installed; sorry) and have added ANT to you're path you can then type "ant" at the command line within this application and it will attempt to run a bunch of test processes on your php code.  This is why all those php library prerequisites were listed way up at the top.

When you execute the ant command ant will look for a build.xml file and then execute a default "target" within that xml file.  If you don't specify a target at the command with ant it uses the default that is defined in the build.xml file.  In our case the default is called "build".  Our build basically just calls a series of other targets to be executed within the file; "prepare,lint,phploc,pdepend,phpmd-ci,phpcs-ci,phpcpd,phpdox,phpunit,phpcb" and each of those targets might call other targets within the file.

* prepare - this just sets up the /build directory
* lint - checks your php code for syntax erorrs by trying to execute or use every .php file in your source heirarchy
* phploc - does some lines of code analysis on your php code
* pdepend - this does a bunch of metrics analysis on your php code.
* phpmd-ci - the php mess detector; basically looks for several potentail problems within your source code.  Helps avoid bugs
* phpcs-ci - looks for coding standard violations and generates an xml report of the problems.
* phpcpd - copy paste detector; looks for duplicate code
* phpdox - documentation generator for php code; if you've commented your classes in the correct syntax javadox style documentation is generated for your code and ends up in your_project/build/api/index.xhtml (uses twitter bootstrap to look pretty)
* phpunit - executes all of your unit tests and generates a report; you can see some results in your_project/build/coverage/index.html
* phpcb - code beautifier; a tool which reformats code to a standard based on a standard set of rules.

It is possible that some of these libraries won't work on windows.  If that is the case then just run `ant phpunit` to just call the phpunit target and at least make sure all of your unit test are executed.  








[axon]:http://bcosca.github.com/fatfree/#data-mappers
[f3]:http://bcosca.github.com/fatfree/
[bs]:https://github.com/twitter/bootstrap/tags
[phpunitHowTo]:http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html