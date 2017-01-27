<?php
require_once('php/constants.php');
require_once('php/classes.php');
require_once('php/functions.php');

$url  = $_GET['url'];
$path = 'components' . str_replace('/', DIRECTORY_SEPARATOR, $url);

// Prevent xss
if (! is_file($path)):
    die('Nope.');
endif;

$paths          = explode('/', $url);
$component      = new Component($paths[1]);
$implementation = array();

try {
    $implementation = $component->getImplementationByUrl($url);
} catch (ImplementationNotFoundException $e) {
    die('wtf?');
}

?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo $implementation->getName();?> - Component City</title>
    <meta charset="UTF-8" />
    <?php foreach($component->getCSSFiles() as $css): ?>
        <link rel="stylesheet" href="<?php echo $css; ?>" />
    <?php endforeach; ?>
</head>
<body>
    <?php echo $implementation->getContent(); ?>
</body>
</html>
