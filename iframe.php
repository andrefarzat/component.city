<?php
require_once('functions.php');
$url  = $_GET['url'];
$path = 'components' . str_replace('/', DIRECTORY_SEPARATOR, $url);

// Prevent xss
if (! is_file($path)):
    die('Nope.');
endif;

$paths          = explode('/', $url);
$component      = generateComponentObjectFromFolder($paths[1]);
$implementation = array();

foreach($component['implementations'] as $imp):
    if ($imp['url'] == $url) $implementation = $imp;
endforeach;

if (empty($implementation)) die('wtf?');

?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo $implementation['name'];?> - Component City</title>
    <meta charset="UTF-8" />
    <?php if($component['hasCss']): ?>
        <link rel="stylesheet" href="/components<?php echo $component['url']; ?>/style.css" />
    <?php endif; ?>
</head>
<body>
    <?php echo $implementation['content']; ?>
</body>
</html>
