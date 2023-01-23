<?php

require_once __DIR__ . "/../classes/Message.php";
require_once __DIR__ . "/../classes/MessagesDatabase.php";

require_once __DIR__ . "/force-admin.php";

$db = new MessagesDatabase();

$success = false;

if (isset($_POST["status"]) && isset($_POST["id"])) {

    $message_status = $_POST["status"];
    $message_id = $_POST["id"];

    $success = $db->update($message_status, $message_id);
} else {
    die("Error updating message");
}

if ($success) {
    header('Location: /exa/pages/admin-messages.php');
}
