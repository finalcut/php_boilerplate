<?php
find_files((class_exists("F3")F3::get('routes')) == null ? "routes/" : F3::get('routes'), '/_routes.php/','includeFiles');
?>  