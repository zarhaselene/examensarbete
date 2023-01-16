<?php
require_once __DIR__ . "/../classes/UsersDatabase.php";
// session_start();

// $success = false;

// if (isset($_POST['username']) && isset($_POST['password'])) {
//     $users_db = new UsersDatabase();
//     $user = $users_db->get_one_by_username($_POST['username']);
//     if ($user && $user->test_password($_POST['password'])) {
//         session_start();
//         $_SESSION['user'] = $user;

//         header('Location: /exa/index.php');
//     } else {
//         header('Location: /exa/index.php?error=invalid_credentials');
//         die();
//     }
// } else {
//     header('Location: /exa/index.php?error=invalid_credentials');
//     die();
// }


session_start();

$success = false;

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
        }
    }
} else {
    echo "ERROR: Invalid input.";
    var_dump($_POST);
    die();
}

if ($success) {
    header("Location: /exa");
} else {
    header('Location: /exa/index.php?error=invalid_credentials');
    die();
}
