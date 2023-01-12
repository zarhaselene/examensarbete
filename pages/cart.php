<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

$products = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];


Template::header('Cart'); ?>
<h2 class="sub-header-text">Cart</h2>

<div class="cart-container">
    <?php if (!$products) : ?> <!-- If cart is empty -->


        <div class="empty-cart">

            <h3 class="cart-empty-text">Your cart is empty</h3>

            <form class="back-button-form" action="/exa/index.php">
                <input class="back-button" type="submit" value="Return to Store" />
            </form>
        </div>

    <?php elseif ($_SESSION["cart"]) : ?> <!-- If cart is NOT empty -->

        <?php foreach ($products as $product) : ?> <!-- List products -->
            <div class="cart">

                <div class="products-cart">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <!-- <img class="products-cart-img" src="<?= $product->img_url ?>" alt="product-img"> -->
                </div>

                <div class="cart-product_info">
                    <h3><?= $product->title ?></h3>
                    <p>$ <?= $product->price ?></p>
                </div>
            </div>
            <br>

        <?php endforeach;
        if ($is_logged_in) { ?>
            <form class="products-cart-form" action="/exa/scripts/post-place-order.php" method="post">
                <input type="hidden" name="customerID" value="<?= $logged_in_user->id ?>">
                <input class="cart-button" type="submit" value="Place order">
            </form>
        <?php } else { ?>
            <p>Please register or login to place order</p>
        <?php } ?>
    <?php endif ?>
</div>



<?= Template::footer(); ?>