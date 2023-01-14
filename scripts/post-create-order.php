<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

session_start();

$products = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$order_sucess = false;

$product_order = false;

if (/* isset($_POST["id"]) && */isset($_SESSION["user"])) {

    /* $product_id = $_POST["id"]; */

    $user = $_SESSION["user"];

    $orders_db = new OrdersDatabase();

    $current_date = date("Y-m-d");

    $status = "ordered";

    $order = new Order($user->id, $status, $current_date);

    $order_success = $orders_db->create($order);

    foreach ($products as $product) {

        $order_id = $order_success;

        $product_id = $product->id;

        $product_order = new ProductOrder($order_id, $product_id);

        $product_order = $orders_db->add_order_to_product_orders($product_order);
    }
} else {
    die("You need to be logged in to place an order");
}

// need to add for both checks
if ($order_success && $product_order) {
    //empty cart
    $_SESSION["cart"] = null;

    header("Location: /php-group3/pages/orders.php");
}
