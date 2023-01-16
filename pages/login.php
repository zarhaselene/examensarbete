<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../google-config.php";
require_once __DIR__ . "/../classes/Template.php";

$google_login_btn = '<a href="' . $google_client->createAuthUrl() . '">Login with Google</a>';

Template::header("Login", "");
?>
<?= $google_login_btn ?>

<?php


Template::footer();
