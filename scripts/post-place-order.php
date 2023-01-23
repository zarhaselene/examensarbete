<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

session_start();
$success = false;

if (isset($_POST["id"]) && isset($_SESSION["user"])) {
    $product_id = $_POST["id"];  //get the product id from the form
    $user = $_SESSION["user"]; //get the logged in user object
    $orders_db = new OrdersDatabase(); //create new instance of OrdersDatabase
    $current_date = date("Y-m-d"); //get the current date
    $status = "Pending"; //set the status of order to pending
    $order = new Order($user->id, $status, $current_date); //create new order object with user's id and current date
    $success = $orders_db->create($order); //create the order in the database
} else {
    echo "Error, not saved to Database";
}

if ($success) {
    $_SESSION["cart"] = null;
    header("location: /exa/pages/orders.php");
} else {
    die("Error placing order");
}
