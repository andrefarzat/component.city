<?php
require_once('functions.php');

$uri = getCurrentUri();


if ($uri == '/'):
    include 'home.php';
elseif ($uri == '/about'):
    die('adicionar about aqui!');
elseif ($uri == '/media'):
    $component = generateComponentObjectFromFolder('media');
    include 'component.php';
else:
    die('adicionar 404 aqui!');
endif;
?>
