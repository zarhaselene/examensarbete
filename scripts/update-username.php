<?php
require_once __DIR__ . "/../classes/UsersDatabase.php";

session_start();

$success = false;

$user_info = $_SESSION["user"];
$id = (int)$_POST["id"];
$username = $_POST["username"];

if (isset($username) && isset($id) && $user_info->id === $id) {

    $db = new UsersDatabase();
    $user = new User($username, '', '', '', '', '',);

    $success = $db->update_my_username($user, $id);
} else {
    echo "ERROR: Invalid input";
}

if ($success) {
    // Get the updated username from the database
    $updated_user_info = $db->get_user_by_id($id);
    // Update the current user session with the updated username
    $_SESSION['user'] = $updated_user_info;
    // Redirect the user back to the account.php page
    header("Location: /exa/pages/account.php");
} else {
    echo "Error: could not update user.";
}
