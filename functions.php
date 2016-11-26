<?php

define('CITY_COMPONENTS_FOLDER', '.' . DIRECTORY_SEPARATOR . 'components');
define('CITY_DEBUG', 1);

class ComponentNotFoundException extends Exception {}

/**
 *
 */
function printHeaderTags()
{
    echo '<meta charset="UTF-8" />';
    echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" />';
    echo '<link rel="stylesheet" href="/css/style.css" />';
}

/**
 * @see http://stackoverflow.com/a/834355/1327401
 */
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

/**
 * @see http://stackoverflow.com/a/834355/1327401
 */
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

/**
 * The following function will strip the script name from URL
 * i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
 * @see http://blogs.shephertz.com/2014/05/21/how-to-implement-url-routing-in-php/
 * @return {string}
 */
function getCurrentUri()
{
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    $uri = '/' . trim($uri, '/');
    return $uri;
}

/**
 * @return {string[]}
 */
function getAllComponents()
{
    $components = array();
    $dirs       = scandir(CITY_COMPONENTS_FOLDER);

    foreach($dirs as $dir) {
        if (! startsWith($dir, '.')) {
            array_push($components, $dir);
        }
    }

    return $components;
}

/**
 * @param {string} $folderName
 * @return {object}
 */
function generateComponentObjectFromFolder($folderName)
{
    $dirPath = CITY_COMPONENTS_FOLDER . DIRECTORY_SEPARATOR . $folderName;

    if (! is_dir($dirPath)) {
        throw new ComponentNotFoundException("Component $folderName doesn't exist!");
    }

    $files = scandir($dirPath);
    $component = array(
        'name'            => $folderName,
        'path'            => $dirPath,
        'url'             => '/' . $folderName,
        'description'     => '',
        'implementations' => array(),
        'hasCss'          => 0,
        'errors'          => array(),
    );

    foreach($files as $file) {
        if (startsWith($file, '.')) {
            continue;
        }

        if (endsWith($file, '.css')) {
            if ($file != 'style.css') {
                $msg = "There can be only 'style.css' as css file. Please, remove '$file' from '$dirPath'.";
                array_push($component['errors'], $msg);
            } else {
                $component['hasCss'] = 1;
            }
            continue;
        }

        if (endsWith($file, '.html')) {
            $implemtation = getImplementationByPath($component, $file);
            array_push($component['implementations'], $implemtation);
            continue;
        }

        if ($file == 'description.txt') {
            $component['description'] = file_get_contents($dirPath . DIRECTORY_SEPARATOR . $file);
            continue;
        }

        $msg = "File '$file' is unnecessary. Please, remove it.";
        array_push($component['errors'], $msg);
    }

    if (empty($component['description'])) {
        $msg = "File 'description.txt' is missing.";
        array_push($component['errors'], $msg);
    }

    return $component;
}

/**
 * @param {object} $component
 * @param {string} $file
 * @return {object}
 */
function getImplementationByPath($component, $file)
{
    $implemtation = array(
        'url'     => $component['url'] . '/' . $file,
        'name'    => $file,
        'content' => file_get_contents($component['path'] . DIRECTORY_SEPARATOR . $file),
    );

    return $implemtation;
}

/**
 * @param {string} $componentName
 * @return {string}
 */
function formatComponentUrl($componentName)
{
    return $componentName;
}

?>
