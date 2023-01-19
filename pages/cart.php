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

            <div class="cart-wrapper row">
                <div class="col-16 display-flex direction-column justify-center">
                    <div class="go-back-btn display-flex align-items-center">
                        <a class="color-white" href="/exa/index.php"><i class='bx bx-arrow-back m-h-1'></i><span>Continue shopping</span>
                        </a>
                    </div>
                    <div class="wrapper display-flex direction-column">

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
                <div class="col-8 display-flex direction-column justify-center">
                    <?php if ($is_logged_in) : ?>

                        <div class="payment">
                            <div class="cell example example1" id="example-1">
                                <form>
                                    <fieldset>
                                        <div class="row">
                                            <label for="example1-name" data-tid="elements_examples.form.name_label">Name</label>
                                            <input id="example1-name" data-tid="elements_examples.form.name_placeholder" type="text" placeholder="Jane Doe" required="" autocomplete="name">
                                        </div>
                                        <div class="row">
                                            <label for="example1-email" data-tid="elements_examples.form.email_label">Email</label>
                                            <input id="example1-email" data-tid="elements_examples.form.email_placeholder" type="email" placeholder="janedoe@gmail.com" required="" autocomplete="email">
                                        </div>
                                        <div class="row noborder-row">
                                            <label for="example1-phone" data-tid="elements_examples.form.phone_label">Phone</label>
                                            <input id="example1-phone" data-tid="elements_examples.form.phone_placeholder" type="tel" placeholder="(941) 555-0123" required="" autocomplete="tel">
                                        </div>
                                    </fieldset>
                                    <div class="display-flex justify-between m-t-4">
                                        <div class="payment-method">
                                            <h3 class="">Payment method</h3>
                                            <small class="">Credit Card</small>

                                        </div>
                                        <a href="#" class="color-pink text-underline">Edit</a>
                                    </div>


                                    <fieldset>
                                        <div class="row noborder-row">
                                            <div id="card"></div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="discount-code m-t-50">
                                <h3>Do you have any discount code?</h3>
                                <p><small>Only one discount code per order can be applied.</small></p>
                                <input class="dcode" type="text" placeholder="Your code here">
                                <input class="discount-btn" type="button" value="APPLY">
                            </div>


                            <div class="total m-t-50">
                                <div class="subtotal display-flex justify-between">
                                    <p>Subtotal (<?= $cart_count ?> items)</p>
                                    <p>$<?= $total ?></p>
                                </div>
                                <div class="shipping display-flex justify-between">
                                    <p>Shipping costs</p>
                                    <p><b>FREE!</b></p>
                                </div>
                                <div class="discount display-flex justify-between">
                                    <p>Discount</p>
                                    <p><b>-</b></p>
                                </div>
                                <div class="cart-total display-flex justify-between m-t-4">
                                    <div class="total-sum">
                                        <p><small>Total (incl. VAT)</small></p>
                                        <h3>$<?= $total ?></h3>
                                    </div>
                                    <button class="cart-button btn full-btn m-z" id="pay" type="submit">Place order</button>
                                </div>
                            </div>

                        </div>
                </div>
            <?php endif; ?>

            <?php if (!$is_logged_in) : ?>
                <p>You need to be logged in to place an order</p>
            <?php endif; ?>
            </div>
            </div>
        </form>
    <?php endif ?>
</section>