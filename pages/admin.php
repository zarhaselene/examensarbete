<?php
require_once __DIR__ . '/../classes/Template.php';

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Order.php";

require_once __DIR__ . '/../classes/ProductsDatabase.php';
require_once __DIR__ . '/../classes/UsersDatabase.php';
require_once __DIR__ . '/../classes/OrdersDatabase.php';

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && $logged_in_user->role == 'admin';

if (!$is_admin) {
    http_response_code(401);
    die('Access denied');
}

$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();
$orders_db = new OrdersDatabase();

$users = $users_db->get_all();
$products = $products_db->get_all();
$orders = $orders_db->get_all_orders();

$pending_orders = [];
foreach ($orders as $order) {
    if ($order->status == 'Pending') {
        array_push($pending_orders, $order);
    }
}
$order_count = count($pending_orders);

Template::header("Admin Dashboard");


?>

<section class="dashboard">
    <?php
    Template::sidebar();

    ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container">
            <h2 class="heading">Dashboard</h2>
            <div class="row">
                <div class="col-14">
                    <div class="welcome">
                        <div class="welcome-text color-white">
                            <h2 class="m-b-1">Hello <?= $logged_in_user->username ?>!</h2>

                            <?php if ($order_count == 0) : ?>
                                <p>There is no new orders yet. &#128532; </p>

                            <?php endif; ?>
                            <?php if ($order_count == 1) : ?>
                                <p>
                                    You have <?= $order_count ?> new order. &#129395;
                                </p>
                                <a href="/exa/pages/admin-orders.php" class="text-underline color-white">Manage orders</a>

                            <?php endif; ?>
                            <?php if ($order_count > 1) : ?>
                                <p>
                                    You have <?= $order_count ?> new orders. It is a lot of work for today!
                                    So let's start. &#129395;
                                </p>
                                <a href="/exa/pages/admin-orders.php" class="text-underline color-white">Manage orders</a>

                            <?php endif; ?>

                        </div>
                        <div class="welcome-image">
                            <img src="/exa/assets/img/illustrations/pink_girl.png" alt="">
                        </div>

                    </div>
                </div>
                <div class="col-10"></div>
            </div>
        </div>
    </div>

</section>