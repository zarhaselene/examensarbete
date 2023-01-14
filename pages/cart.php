<?php
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

$products_db = new ProductsDatabase();
$products = $products_db->get_all();
$products = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$total = 0;

foreach ($products as $product) {
    $total += $product->price;
}

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header('Cart'); ?>

<section class="shopping-cart position-relative">

    <?php if (!$products) : ?>
        <a class="go-back-btn" href="/exa/index.php"> <- Continue shopping</a>

                <!-- No products  -->
            <?php elseif ($_SESSION["cart"]) : ?>

                <form action="/exa/scripts/post-place-order.php" method="post">

                    <div class="row">
                        <div class="col-16">
                            <a class="go-back-btn" href="/exa/index.php"> <- Continue shopping</a>
                                    <div class="heading display-flex align-items-center">
                                        <h2>Shopping cart</h2>
                                        <span class="p-h-5 color-pink"><b><?= $cart_count ?> items</b> </span>
                                    </div>
                                    <?php foreach ($products as $product) : ?>
                                        <div class="cart-item m-v-2 display-flex align-items-center">
                                            <input type="hidden" name="id" value="<?= $product->id ?>">
                                            <div class="image p-r-2">
                                                <img class="products-cart-img" src="<?= $product->img_url ?>" alt="product-img">
                                            </div>
                                            <div class="item-info">
                                                <h3><?= $product->title ?></h3>
                                                <p>$<?= $product->price ?></p>
                                            </div>

                                        </div>

                                    <?php endforeach ?>


                        </div>
                        <div class="col-8">
                            <p>PAYMENT</p>
                            <span class="cart-total">
                                <h3>Total price: $<?= $total ?></h3>
                            </span> <?php if ($is_logged_in) : ?>
                                <input class="cart-button" type="submit" value="Place order">
                            <?php endif; ?>

                            <?php if (!$is_logged_in) : ?>
                                <p>You need to be logged in to place an order</p>
                            <?php endif; ?>
                        </div>
                </form>

                </div>
            <?php endif ?>
</section>