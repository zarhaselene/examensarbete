<?php

session_start();

if (isset($_POST['empty_cart']) && isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    header("Location: /exa/pages/cart.php");
    die();
} else {
    echo "Error removing item(s) from cart";
    header("Location: /exa/pages/cart.php");
    die();
}
