<?php
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

session_start();

if (isset($_POST['product-id'])) {

    //Get picked products
    $products_db = new ProductsDatabase();
    $product = $products_db->get_one($_POST["product-id"]);

    //Create cart if non existent
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Add products to cart
    if ($product) {
        $_SESSION['cart'][] = $product;
        // Redirect to product page
        header('Location: /exa/pages/products.php');
        die();
    }
} else {
    die('Invalid input');
}

die('Error adding product(s) to cart');
