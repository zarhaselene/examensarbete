<?php
require_once __DIR__ . "/../google-config.php";

//Destroy entire session data.
session_destroy();
session_start();
unset($_SESSION['user']);

//Reset OAuth access token
$google_client->revokeToken();
session_destroy();
header('Location: /exa');
