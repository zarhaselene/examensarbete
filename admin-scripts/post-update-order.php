<?php

require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

require_once __DIR__ . "/force-admin.php";

$db = new OrdersDatabase();

$success = false;

if (isset($_POST["status"]) && isset($_POST["id"])) {

    $order_status = $_POST["status"];
    $order_id = $_POST["id"];

    $success = $db->update_order($order_status, $order_id);
} else {
    die("Error updating order");
}

if ($success) {
    header('Location: /exa/pages/admin-orders.php');
}
