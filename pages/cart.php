<?php
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

$products_db = new ProductsDatabase();
$products = $products_db->get_all();
$products = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header('Cart'); ?>
<h2 class="sub-header-text">Cart</h2>

<div class="cart-container">
    <?php if (!$products) : ?>


    <?php elseif ($_SESSION["cart"]) : ?>


        <form class="products-cart-form" action="/exa/scripts/post-place-order.php" method="post">

            <?php foreach ($products as $product) : ?>
                <hr>
                <br>
                <div class="cart">

                    <div class="products-cart">
                        <input type="hidden" name="id" value="<?= $product->id ?>">
                        <img class="products-cart-img" src="<?= $product->img_url ?>" alt="product-img">
                    </div>

                    <div class="cart-product_info">
                        <h3><?= $product->title ?></h3>
                        <p>$ <?= $product->price ?></p>
                    </div>
                </div>
                <br>

            <?php endforeach ?>
            <br>
            <?php if ($is_logged_in) : ?>
                <input class="cart-button" type="submit" value="Place order">
            <?php endif; ?>

            <?php if (!$is_logged_in) : ?>
                <p>You need to be logged in to place an order</p>
            <?php endif; ?>
        </form>
    <?php endif ?>
</div>