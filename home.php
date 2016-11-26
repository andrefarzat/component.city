<?php require_once('functions.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <title>Component City</title>
    <?php printHeaderTags(); ?>
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

                <ol class="list +bullet">
                    <?php foreach(getAllComponents() as $i => $component): ?>
                        <li class="list-item">
                            <a href="/<?php echo formatComponentUrl($component); ?>" class="link"><?php echo $component; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</body>
</html>
