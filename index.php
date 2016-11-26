<?php
require_once('functions.php');

$uri = getCurrentUri();


if ($uri == '/'):
    include 'home.php';
elseif ($uri == '/about'):
    die('adicionar about aqui!');
elseif (preg_match('/^\/[\w\-]+$/', $uri, $matches)):
    $componentName = substr($matches[0], 1, strlen($matches[0]));
    try {
        $component = generateComponentObjectFromFolder($componentName);
    } catch(ComponentNotFoundException $e) {
        include '404.php';
    }
else:
    include '404.php';
endif;
?>
