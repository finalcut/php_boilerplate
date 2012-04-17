# Introduction
This is "getting started" point for any PHP applications you might want to develop for deployment onto the Marshall public facing webservers.   It uses the MVC (Model-View-Controller) pattern as provided by the [Fat Free Framework][f3].  The look and feel id dictated by the unified "bootstrap" interface developed as a customized version of [Twitter Bootstrap][bs].  Ideally it will be fairly easy to navigate around the project and to start developing your own functionality.  If you have any questions as you proceed (and after you've read this entire document) please email me at wmr@marshall.edu and I'll do my best to help you.

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
Almost everything you need to actually get the bootstrap app working is included in the initial clone of the repository.  

1. Clone the git repository at git@git.marshall.edu:/var/git/web_base/bootstrap.git  - NOTE: you need the ["marshall" branch](http://stackoverflow.com/a/7034921).  You should put this in a sibling directory to the one you put the php_bootstrap project in.  Thus if you have php_boilerplate cloned into a directory called "Foo" at c:\inetpub\wwwroot\foo then you'd want to clone bootrap to c:\inetpub\wwwroot\bootstrap.  Once you do this for one php boilerplate project you won't have to do it on your development box again.  Each boilerplate project can share the same bootstrap copy.
2. That should be it.  The bootstrap project includes the following additional useful libraries:  jquery, jquery-input-mask, and jquery-validate.

#### Second Interlude : Javascript Unit Testing
You should definitely be doing this.  However, because javascript problems will be isolated to harming the usability of your site only they are not required at the moment.  Our continuous integration server is not currently configured to provide   access to integration testing of javascript unit tests.  This may be added in the future and I strongly encourage you to look into the various JS Unit Testing frameworks.  You may also want to consider user interface testing with something like Selenium.  There is a selenium extension for FireFox that you can use to help create your UI tests.

__SERIOUSLY, UNIT TESTING IS GREAT__

# Code Organization
If this is your first time touching the project it might seem a little overwhelming.  Fear not!  It's not that bad and, in some places, you can just ignore some of the directories that are contained here.  Basically, within the project there are four top level directories:

* /build  - You'll never have to touch anything in /build.   The ANT build process uses the /build directory.  I'll explain ANT a little more later along with some details about the build file and the two phpunit.xml.* files.  
* /f3 - You'll never have to touch anything in /f3 - in fact DON'T touch anything in F3.  It is a framework we are using and any changes you make to it here won't be reflected in production so don't muck with F3
* /src - this is the actual project.  Anything in this directory is what will be deployed to production.  Thus, if you have a web application anmed "Foo" then on the production server you should imagine Foo == /src.  
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









[f3]:http://bcosca.github.com/fatfree/
[bs]:https://github.com/twitter/bootstrap/tags
[phpunitHowTo]:http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html