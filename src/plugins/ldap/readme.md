# Introduction
This plugin provides LDAP Active Directory integration to your application.  It's pretty simple to use and you should be able to get your own app setup quickly by following the steps found on in this readme file.

# Installation
Couldn't be much simpler; just put the ldap directory into your plugins directory.  Ideally you are using the autoload (sh or bat) script contained at the root of the boilerplate project.  If so then run the corresponding autoload file and it will update your autoload.php files as necessary.  In order to use the autoload script you need to have [php autoload library](https://github.com/theseer/Autoload) installed.

# Configuration
On first glance it will appear there are a lot of configuration options.  Fortunately, for the most part, you only have to be concerned with a couple.  Thus I'll breakt his down into two sections; Important and Optional.  All of your options need to be defined in the apps config.cfg and are in a structure called ActiveDirectory.

NOTE:  All configuration options are CASE SENSITIVE!

## Important Options
	1. activeDirectory.useActiveDirectory  (true|false) - if you set this to false it will turn off the ldap plugin.
	2. activeDirectory.accountSuffix - what domain account ending do you use; i.e.  @yourdomain.com
	3. activeDirectory.baseDN - directory controllers. 

## Optional Options

