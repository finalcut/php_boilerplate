<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'adldap' => '/plugins/ldap/lib/adLDAP.php',
                'adldapexception' => '/plugins/ldap/lib/adLDAP.php',
                'marshall\\core\\base' => '/core/Base.php',
                'marshall\\core\\basecontroller' => '/core/BaseController.php',
                'marshall\\core\\basedao' => '/core/BaseDAO.php',
                'marshall\\core\\baseplugin' => '/core/BasePlugin.php',
                'marshall\\core\\baseuser' => '/core/BaseUser.php',
                'marshall\\core\\error' => '/core/Error.php',
                'marshall\\core\\menu' => '/core/Menu.php',
                'marshall\\core\\menuitem' => '/core/MenuItem.php',
                'marshall\\core\\nonpersistentbean' => '/core/NonPersistentBean.php',
                'marshall\\core\\session' => '/core/session.php',
                'marshall\\plugins\\ldap\\_plugin' => '/plugins/ldap/_plugin.php',
                'marshall\\plugins\\ldap\\ldapcontroller' => '/plugins/ldap/LdapController.php',
                'marshall\\plugins\\ldap\\services\\ldapservice' => '/plugins/ldap/services/ldapService.php',
                'php_boilerplate\\plugins\\books\\_plugin' => '/plugins/books/_plugin.php',
                'php_boilerplate\\plugins\\books\\bookcontroller' => '/plugins/books/BookController.php',
                'php_boilerplate\\plugins\\books\\data\\books' => '/plugins/books/data/Books.php',
                'php_boilerplate\\plugins\\directory\\_plugin' => '/plugins/directory/_plugin.php',
                'php_boilerplate\\plugins\\directory\\directory' => '/plugins/directory/Directory.php',
                'php_boilerplate\\plugins\\formbuilder\\_plugin' => '/plugins/formbuilder/_plugin.php',
                'php_boilerplate\\plugins\\formbuilder\\formbuilder' => '/plugins/formbuilder/FormBuilder.php',
                'php_boilerplate\\plugins\\home\\_plugin' => '/plugins/home/_plugin.php',
                'php_boilerplate\\plugins\\other\\_plugin' => '/plugins/other/_plugin.php',
                'php_boilerplate\\plugins\\other\\other' => '/plugins/other/Other.php',
                'php_boilerplate\\plugins\\users\\_plugin' => '/plugins/users/_plugin.php',
                'php_boilerplate\\plugins\\users\\model\\user' => '/plugins/users/model/User.php',
                'php_boilerplate\\plugins\\users\\users' => '/plugins/users/Users.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd