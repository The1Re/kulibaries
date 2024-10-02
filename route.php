<?php

#  show error information
error_reporting(E_ALL);
ini_set('display_errors', true);

/* 
    Get controller and action in query params
    if not assign default controller = page & action = home
*/
$controller = $_GET['controller'] ?? 'page';
$action = $_GET['action'] ?? 'home';

#   customize controllers
$controllers = [
    'page' => ['home', 'error']
];

function call(string $controller, string $action)
{
    require("controllers/" . $controller . "_controller.php");
    switch ($controller)
    {
        case 'page':
            $controller_obj = new PageController();
            break;
    }
    $controller_obj->$action();
}

if (key_exists($controller, $controllers) && in_array($action, $controllers[$controller]))
    call($controller, $action);
else
    call('page', 'error');