<?php

/**
 * Prints the tags to be added in all <head>
 */
function printHeaderTags()
{
    echo '<meta charset="UTF-8" />' . "\n";
    echo '<link rel="shortcut icon" href="/images/favicon.png" type="image/png">' . "\n";
    echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" />' . "\n";
    echo '<link rel="stylesheet" href="/css/style.css" />' . "\n";

    // google analytics
    echo <<<'EOT'
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88055455-1', 'auto');
  ga('send', 'pageview');
</script>
EOT;

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
            array_push($components, new Component($dir));
        }
    }

    return $components;
}

?>