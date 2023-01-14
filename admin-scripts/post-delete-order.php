<?php
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/force-admin.php";

$success = false;
if (isset($_POST['id'])) {
    $orders_db = new OrdersDatabase();
    $success = $orders_db->delete_order($_POST['id']);
} else {
    die('Invalid input');
}

if ($success) {
    header('Location: /exa/pages/admin-orders.php');
    die();
} else {
    die('Error deleting order');
}
