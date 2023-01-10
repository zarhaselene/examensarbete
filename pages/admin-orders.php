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

$order_id = $orders_db->get_order_by_user_id($orders);

/*
TODO
if user-id(order) is the same as id(user) get username
*/

$hold_orders = [];
$delivered_orders = [];
$pending_orders = [];

foreach ($orders as $order) {
    if ($order->status == 'Hold') {
        array_push($hold_orders, $order);
    } elseif ($order->status == 'Delivered') {
        array_push($delivered_orders, $order);
    } elseif ($order->status == 'Pending') {
        array_push($pending_orders, $order);
    }
}






Template::header("Admin Dashboard");

?>

<section class="dashboard">
    <?php
    Template::sidebar();

    ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container">
            <h2 class="heading">Orders</h2>
            <div class="admin-top-container">
                <div class="tracking">
                    <h1 class="color-pink"><?= count($orders) ?></h1>
                    <p>Total Orders</p>
                </div>
                <div class="tracking">
                    <h1 class="color-green"><?= count($delivered_orders) ?></h1>
                    <p>Total Delivered</p>
                </div>
                <div class="tracking">
                    <h1 class="color-blue"><?= count($pending_orders) ?></h1>
                    <p>Pending Orders</p>
                </div>
                <div class="tracking">
                    <h1 class="color-red"><?= count($hold_orders) ?></h1>
                    <p>Orders Hold</p>
                </div>
            </div>
            <div class="orders">
                <table class="m-t-50" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Order Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td>#<?= $order->id ?></td>
                                <td>#<?= $order->user_id ?></td>
                                <td><?= $order->order_date ?></td>
                                <td>$</td>

                                <td class="td-status">
                                    <span><?= $order->status ?></span>

                                </td>
                                <td><a href=""></a></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>