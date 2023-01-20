<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$success = false;

if (
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm-password']) &&
    strlen($_POST['username']) <= 10 && //String limit: 10
    strlen($_POST['password']) > 0 &&
    $_POST['password'] === $_POST['confirm-password']
) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $users_db = new UsersDatabase();
    // creating new user object with username and role as customer
    $user = new User($_POST['username'], 'customer');
    // hashing the password
    $user->hash_password($password);
    // checking if user with the same username already exists
    $existing_user = $users_db->get_one_by_username($username);

    if ($existing_user) {
        header('Location: /exa/pages/register.php?error=invalid_register_username');
        die();
    } else {
        $success = $users_db->create($user);
    }
} else {
    header('Location: /exa/pages/register.php?error=invalid_register');
    die();
}

if ($success) {
    header("Location: /exa/pages/register.php?register=success");
} else {
    header('Location: /exa/pages/register.php?error=invalid_register');
    die();
}
