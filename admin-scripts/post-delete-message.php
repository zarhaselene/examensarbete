<?php
require_once __DIR__ . "/../classes/MessagesDatabase.php";
require_once __DIR__ . "/force-admin.php";

$success = false;
if (isset($_POST['id'])) {
    $messages_db = new MessagesDatabase();
    $success = $messages_db->delete($_POST['id']);
} else {
    die('Invalid input');
}

if ($success) {
    header('Location: /exa/pages/admin-messages.php');
    die();
} else {
    die('Error deleting order');
}
