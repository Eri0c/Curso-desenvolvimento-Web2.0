<?php 

    session_start();
    require('vendor/autoload.php');

    define('INCLUDE_PATH_STATIC','http://localhost/redesocialdevweb/DankiCode/Views/pages/');
    define('INCLUDE_PATH','http://localhost/redesocialdevweb/');
    
    $app = new DankiCode\Application();

    $app->run();
    
