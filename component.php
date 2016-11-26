<?php require_once('functions.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo $component['name']; ?> - Component City</title>
    <?php printHeaderTags(); ?>
</head>
<body>
    <div class="container +main">
        <div class="row">
            <div class="col-12">
                <h1 class="hugefuckinglogo">
                    <a href="/" class="hugefuckinglogo-image"></a> / <?php echo $component['name']; ?>
                </h1>

                <div class="spacer +big"></div>

                <?php if(! empty($component['description'])): ?>
                    <div class="text"><?php echo htmlspecialchars($component['description'], ENT_COMPAT, 'UTF-8'); ?> </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="spacer +big"></div>

        <div class="row">
            <div class="col-12">
                <?php foreach($component['implementations'] as $implementation): ?>
                <div class="implementation">
                    <div class="implementation-name"><?php echo $implementation['name']; ?></div>
                    <iframe class="implementation-iframe" src="iframe.php?url=<?php echo $implementation['url']; ?>" width="100%" height="400px"></iframe>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if(CITY_DEBUG && !empty($component['errors'])): ?>
        <div class="container +main">
            <div class="row col-12">
                <h3>Errors: </h3>
                <?php foreach($component['errors'] as $error): ?>
                    <pre><?php echo $error; ?></pre>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
