<?php
require_once('auto_include_files.php');
find_files(F3::get('plugins') == null ? "plugins/" : F3::get('plugins'), '/_autoload.php/','includeFiles');
?>	