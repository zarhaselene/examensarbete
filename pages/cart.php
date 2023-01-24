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
    <?php if (!$products) : ?> <!-- If no products  -->
        <div class="empty-cart-container display-flex direction-column align-items-center justify-center">
            <iframe class="lottie-animation" frameBorder="0" src="https://embed.lottiefiles.com/animation/134454"></iframe>
            <h2 class="p-t-2">Your Cart is Empty</h2>
            <p class="p-t-2">Looks like you haven't added anything to your cart yet.</p>
            <a href="/exa/index.php" class="btn full-btn">Continue shopping</a>
        </div>
    <?php elseif ($_SESSION["cart"]) : ?>
        <form action="/exa/scripts/post-place-order.php" method="post">
            <div class="cart-wrapper row">
                <div class="col-16 display-flex direction-column justify-center">
                    <div class="go-back-btn display-flex align-items-center">
                        <a class="color-white" href="/exa/index.php"><i class='bx bx-arrow-back m-h-1'></i><span>Continue shopping</span>
                        </a>
                    </div>
                    <div class="wrapper display-flex direction-column">
                        <div class="heading display-flex align-items-center justify-between">
                            <div class="display-flex align-items-center">
                                <h2>Shopping cart</h2>
                                <span class="p-h-5 color-pink"><b><?= $cart_count ?> items</b> </span>
                            </div>
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
                                        <p>$<?= $product->price ?>.00</p>
                                    </div>
                                </div>
                                <div class="hr"></div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="col-8 display-flex direction-column justify-center">
                    <div class="payment-wrapper">
                        <div class="cell payment">
                            <form>
                                <h3 class="p-b-2">Account Details</h3>
                                <fieldset>
                                    <div class="row">
                                        <label for="payment-name" data-tid="elements_payments.form.firstname_label">First name</label>
                                        <input id="payment-name" data-tid="elements_payments.form.firstname_placeholder" type="text" placeholder="Jane" required="" autocomplete="first name" value="<?= $is_logged_in ? $logged_in_user->firstname : '' ?>">
                                    </div>
                                    <div class="row">
                                        <label for="payment-name" data-tid="elements_payments.form.lastname_label">Last name</label>
                                        <input id="payment-name" data-tid="elements_payments.form.lastname_placeholder" type="text" placeholder="Doe" required="" autocomplete="last name" value="<?= $is_logged_in ? $logged_in_user->lastname : '' ?>">
                                    </div>
                                    <div class="row noborder-row">
                                        <label for="payment-email" data-tid="elements_payments.form.email_label">Email</label>
                                        <input id="payment-email" data-tid="elements_payments.form.email_placeholder" type="email" placeholder="janedoe@gmail.com" required="" autocomplete="email" value="<?= $is_logged_in ? $logged_in_user->email : '' ?>">
                                    </div>
                                </fieldset>

                                <div class="display-flex justify-between m-t-4">
                                    <div class="payment-method">
                                        <h3>Payment method</h3>
                                        <small>Credit Card</small>
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
                            <div class="position-relative">
                                <input class="dcode" type="text" placeholder="Your code here">
                                <input class="discount-btn" type="button" value="APPLY">
                                <small id="discount-message"></small>
                            </div>
                        </div>
                        <div class="total m-t-50">
                            <div class="subtotal display-flex justify-between">
                                <p>Subtotal (<?= $cart_count ?> items)</p>
                                <p>$<?= $total ?>.00</p>
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
                                    <h3>$<?= $total ?>.00</h3>
                                </div>
                                <?php if ($is_logged_in) : ?>
                                    <button class="btn full-btn m-z" id="pay" type="submit">Place order</button>
                                <?php endif; ?>
                                <?php if (!$is_logged_in) : ?>
                                    <div class="not-logged-in position-relative display-flex direction-column align-items-center">
                                        <div class="tool-tip">
                                            You need to login to place an order.
                                        </div>
                                        <div class="grey-cart-button btn m-z">
                                            Place order
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
        <form action="/exa/scripts/post-empty-cart.php" method="post">
            <button class="empty-cart-btn btn full-btn" type="submit" name="empty_cart">Empty Cart</button>
        </form>
    <?php endif ?>
</section>