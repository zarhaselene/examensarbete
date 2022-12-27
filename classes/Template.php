<?php

class Template
{
    public static function header($title)
    {

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> <?= $title ?> </title>
            <link rel="stylesheet" href="/exa/assets/style.css">
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Varela+Round&display=swap" rel="stylesheet">

            <!-- Font Awesome -->
            <script src="https://kit.fontawesome.com/57a104828d.js" crossorigin="anonymous"></script>

        </head>

        <body>

        </body>

        </html>
<?php
    }
}
