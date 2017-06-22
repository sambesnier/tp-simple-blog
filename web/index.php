<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 09:40
 */

// Starting session
session_start();

// Get controller name
if( isset($_GET['controller']) ) {
    $controllerName = $_GET['controller'];
}
else {
    $controllerName = 'home';
}

// Set project's root path
define('ROOT_PATH', dirname(__DIR__));

// Include project's dépendancies
require ROOT_PATH.'/src/framework/mvc.php';
require ROOT_PATH.'/src/config/config.php';

// Set controller path
$controllerPath = ROOT_PATH.'/src/controllers/'.$controllerName.'.php';

// Test controller existence
if(! file_exists($controllerPath)) {
    // Set controller path to error page
    $controllerPath = ROOT_PATH.'/src/controllers/error.php';
}

// Execute controller
require $controllerPath;