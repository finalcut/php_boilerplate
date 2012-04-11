<?php
/*
	this file basically just intelligently finds your routes files within your controllers directories..



*/
function find_files($path, $pattern, $callback) {
  $path = rtrim(str_replace("\\", "/", $path), '/') . '/*';
                                 
  foreach (glob ($path) as $fullname) {
    if (is_dir($fullname)) {
      find_files($fullname, $pattern, $callback);
    } else if (preg_match($pattern, $fullname)) {
      call_user_func($callback, $fullname);
    }
  }
}

function includeFiles($path){
	include($path);
}

?>