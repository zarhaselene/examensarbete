<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$logged_in_user = $_SESSION["user"];

$orders_db = new OrdersDatabase();

$orders = $orders_db->get_order_by_user_id($logged_in_user->id);

Template::header("My account - Orders");
?>

<section class="my-account">
    <div class="go-back-container">
        <a class="go-back" href="/exa/index.php"> <i class='bx bx-arrow-back'></i> Continue shopping</a>

    </div>

    <div class="account-nav display-flex direction-column align-items-start justify-end">
        <div class="heading m-z display-flex align-items-center">
            <h2>Your Orders</h2>
            <p class=" p-h-1">(<?= count($orders) ?>)</p>
        </div>
        <div class="account-navbar">
            <ul class="display-flex align-items-center">
                <li class="current">
                    <a href="#">Orders</a>
                </li>
                <li>
                    <a href="/exa/pages/account.php">Account</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="orders-container">
        <div class="row">
            <div class="col-7">

                <ul class="order-list">
                    <h2 class="p-l-5 p-b-2">Orders History</h2>
                    <?php foreach ($orders as $order) :
                        $products = $orders_db->get_products_by_order($order->id);
                        $total_price = 0;
                        $product_count = 0;
                        foreach ($products as $product) :
                            $total_price += $product->price;
                            $product_count++;
                        endforeach;
                    ?>
                        <li class="order-item">
                            <div class="display-flex align-items-center justify-between">
                                <p class="order-id">
                                    <b>#4812<?= $order->id ?></b>
                                </p>
                                <span class=" order 
                                        <?php
                                        if ($order->status === "Pending") {
                                            echo  "pending";
                                        } elseif ($order->status === "Sent") {
                                            echo "sent";
                                        } elseif ($order->status === "Canceled") {
                                            echo "canceled";
                                        } ?>
                                        ">
                                    <?= $order->status ?>
                                </span>
                            </div>
                            <div class="display-flex justify-between">
                                <div class="display-flex direction-column">
                                    <span><b>$<?= $total_price ?>.00</b></span>
                                    <span><?= $product_count ?> Items</span>
                                </div>
                                <small> <?= $order->order_date ?>
                                </small>
                            </div>

                        </li>


                    <?php endforeach; ?>
                </ul>

            </div>
            <div class="col-17">
                <div class="order-overview">

                </div>
            </div>
        </div>

    </div>
</section>
<!-- 
<?php foreach ($orders as $order) :
    $products = $orders_db->get_products_by_order($order->id);

    $total_price = 0;
?>
                    <p>
                        <b>Order (# <?= $order->id ?>)</b>
                        [<?= $order->status ?>]
                    </p>

                    <?php foreach ($products as $product) :
                        $total_price += $product->price;
                    ?>
                        <div class="profile-show-all">
                            <p class="link">
                                <?php echo $product->title ?>
                                <?php echo " - $" . $product->price ?>
                            </p>
                        </div>

                    <?php endforeach; ?>

                    <div class="total-price">
                        <p>
                            <?php echo "Total price: $" . $total_price ?>
                        </p>
                    </div>

                    <br>
                <?php endforeach; ?>
 -->


<?
Template::footer();
