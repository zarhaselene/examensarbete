<?php
require_once __DIR__ . "/../classes/UsersDatabase.php";
session_start();

$success = false;

if (isset($_POST["id"])) {

    $db = new UsersDatabase();
    $userId = $_POST["id"];

    $success = $db->delete($userId);
} else {
    echo "Invalid input";
}

if ($success) {
    session_destroy();
    header("Location: /exa");
} else {
    echo "Error: could not delete account.";
}
