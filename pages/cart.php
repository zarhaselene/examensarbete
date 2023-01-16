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
        <a class="go-back-btn" href="/exa/index.php"> <i class='bx bx-arrow-back'></i> Continue shopping</a>

        <!-- No products  -->
    <?php elseif ($_SESSION["cart"]) : ?>

        <form action="/exa/scripts/post-place-order.php" method="post">

            <div class="row">
                <div class="col-16 display-flex direction-column justify-end ">
                    <div class="wrapper display-flex direction-column justify-between">
                        <div class="go-back-btn display-flex align-items-center">

                            <a class="color-white href=" /exa/index.php"><i class='bx bx-arrow-back m-h-1'></i><span>Continue shopping</span>
                            </a>
                        </div>
                        <div class="heading display-flex align-items-center">
                            <h2>Shopping cart</h2>
                            <span class="p-h-5 color-pink"><b><?= $cart_count ?> items</b> </span>
                        </div>
                        <div class="cart-items-container">

                            <?php foreach ($products as $product) : ?>
                                <div class="cart-item m-b-4 display-flex align-items-center">
                                    <input type="hidden" name="id" value="<?= $product->id ?>">
                                    <div class="image p-r-2">
                                        <img class="products-cart-img" src="<?= $product->img_url ?>" alt="product-img">
                                    </div>
                                    <div class="item-info">
                                        <h3><?= $product->title ?></h3>
                                        <p>$<?= $product->price ?></p>
                                    </div>
                                </div>
                                <div class="hr"></div>

                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <?php if ($is_logged_in) : ?>
                        <span class="cart-total">
                            <h3>Total: $<?= $total ?></h3>
                        </span>
                        <button class="cart-button btn full-btn " type="submit">Place order</button>
                    <?php endif; ?>

                    <?php if (!$is_logged_in) : ?>
                        <p>You need to be logged in to place an order</p>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    <?php endif ?>
</section>