<?php
require_once __DIR__ . "/../classes/UsersDatabase.php";

session_start();
$success = false;
$error_message = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $db = new UsersDatabase();
    $user = $db->get_one_by_username($username);
    if ($user) {
        $success = $user->test_password($password);
        if ($success) {
            $_SESSION["loggedIn"] = true;
            $_SESSION["user"] = $user;
            header("Location: /exa");
            die();
        } else {
            $error_message = "Invalid credentials. Please try again.";
            header("Location: /exa/pages/login.php?error=invalid_credentials");
        }
    } else {
        $error_message = "Invalid credentials. Please try again.";
        header("Location: /exa/pages/login.php?error=invalid_credentials");
    }
} else {
    $error_message = "Invalid input.";
    header("Location: /exa/pages/login.php?error=invalid_credentials");
}
