<?php

spl_autoload_register(function($class) 
{
    // If class does not exist, we will attempt to find
	// at two places (include and classes folder)
	$base = dirname(__DIR__);
	$folders = array(
		"includes" => $base . "/includes/",
		"classes" => $base . "/classes/"
	);
	
    foreach($folders as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            include_once($file);
            break;
        }
    }
});

?>