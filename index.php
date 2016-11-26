<!doctype html>
<html lang="en">
<head>
    <title>Component City</title>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <h1 class="hugefuckinglogo">
                    <span class="hugefuckinglogo-image"></span>
                    Component.City
                </h1>

                <div class="spacer +big"></div>

                <ol class="list +inline">
                    {% for component in components %}
                        <li class="list-item">
                            <a href="{{ component.url }}" class="linkpill">{{ component.name }}</a>
                        </li>
                    {% endfor %}
                </ol>

            </div>
        </div>
    </div>
</body>
</html>
