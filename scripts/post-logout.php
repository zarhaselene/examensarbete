<?php
require_once __DIR__ . "/../google-config.php";

session_start();
//Reset OAuth access token
$google_client->revokeToken();
unset($_SESSION['user']);
//Destroy entire session data.
session_destroy();
//redirect page to index.php
header('Location: /exa');
