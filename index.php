<?php
require_once('php/constants.php');
require_once('php/classes.php');
require_once('php/functions.php');

$uri = getCurrentUri();


if ($uri == '/'):
    include 'pages/home.php';
elseif ($uri == '/about'):
    die('adicionar about aqui!');
elseif (preg_match('/^\/[\w\-]+$/', $uri, $matches)):
    $componentName = substr($matches[0], 1, strlen($matches[0]));
    try {
        $component = new Component($componentName);
        include 'pages/component.php';
    } catch(ComponentNotFoundException $e) {
        include 'pages/404.php';
    }
else:
    include 'pages/404.php';
endif;
?>
