<?php


session_start();

if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $products = $orders_db->get_products_by_order($orderId);
    $html = "";
    foreach ($products as $product) {
        $html .= "<div>Product name: " . $product->title . "</div>";
        $html .= "<div>Product price: " . $product->price . "</div>";
    }
    echo $html;
}
