<?php
require_once __DIR__ . "/../classes/UsersDatabase.php";

session_start();

$success = false;

$user_info = $_SESSION["user"];
$id = (int)$_POST["id"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];

if (isset($firstname) && isset($lastname) && isset($email) && isset($id) && $user_info->id === $id) {
    $db = new UsersDatabase();
    $user = new User('', '', $firstname, $lastname, $email);
    $success = $db->update_account($user, $id);
} else {
    echo "Error: Invalid input";
}

if ($success) {
    // Get the updated user information from the database
    $updated_user_info = $db->get_user_by_id($id);
    // Update the current user session with the updated user information
    $_SESSION['user'] = $updated_user_info;
    // Redirect the user back to the account.php page
    header("Location: /exa/pages/account.php");
} else {
    echo "Error: could not update user.";
}
