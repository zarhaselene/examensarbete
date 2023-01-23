<?php
require_once __DIR__ . "/../classes/Message.php";
require_once __DIR__ . "/../classes/MessagesDatabase.php";

session_start();

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message_text = $_POST['message'];
    $date = date("Y-m-d H:i:s");
    $status = "Unread";

    $messages_db = new MessagesDatabase();
    $message = new Message($name, $email, $message_text, $date, $status);
    $success = $messages_db->create($message);
    if ($success) {
        $response = [
            'success' => true,
            'confirmation' => 'Message sent successfully'
        ];
        echo json_encode($response);
        die();
    } else {
        $response = [
            'success' => false,
            'confirmation' => 'Error submitting message'
        ];
        echo json_encode($response);
        die();
    }
} else {
    $response = [
        'success' => false,
        'confirmation' => 'Invalid input'
    ];
    echo json_encode($response);
    die();
}
