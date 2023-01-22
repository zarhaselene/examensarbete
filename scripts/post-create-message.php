<?php
require_once __DIR__ . "/../classes/Message.php";
require_once __DIR__ . "/../classes/MessagesDatabase.php";

$success = false;

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $date = date("Y-m-d H:i:s");

    $messages_db = new MessagesDatabase();

    $message_obj = new Message($name, $email, $message, $date);

    $success = $messages_db->create($message_obj);
} else {
    echo "Error, not saved to Database";
}

if ($success) {
    header("location: /exa/");
} else {
    die("Error submitting message");
}
