<?php require_once('functions.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <title>Component City</title>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
    <div class="container +main">
        <div class="row">
            <div class="col-12">

                <h1 class="hugefuckinglogo">
                    <span class="hugefuckinglogo-image"></span>
                    Component.City
                </h1>

                <div class="spacer +big"></div>

                <ol class="list +inline">
                    <?php foreach(getAllComponents() as $component): ?>
                        <li class="list-item">
                            <a href="/<?php echo formatComponentUrl($component); ?>" class="linkpill"><?php echo $component; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</body>
</html>
