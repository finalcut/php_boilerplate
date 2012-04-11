<?php
find_files(F3::get('routes') == null ? "routes/" : F3::get('routes'), '/_routes.php/','includeFiles');
?>  