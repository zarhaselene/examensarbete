<?php
require_once __DIR__ . '/../classes/Template.php';

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . '/../classes/UsersDatabase.php';

require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . '/../classes/OrdersDatabase.php';

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . '/../classes/ProductsDatabase.php';

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && $logged_in_user->role == 'admin';

if (!$is_admin) {
    http_response_code(401);
    die('Access denied');
}

$products_db = new ProductsDatabase();
$products = $products_db->get_all();

$users_db = new UsersDatabase();
$users = $users_db->get_all();

$orders_db = new OrdersDatabase();
$orders = $orders_db->get_all_orders();

// $user_id = $users_db->get_user_by_id($id);
// $order_id = $orders_db->get_order_by_id($id);

// $username_by_id = $orders_db->get_username_by_order_id($order_id);

// $order_id = $orders_db->get_order_by_user_id($orders);
// $customer_orders = $orders_db->get_order_by_user_id($logged_in_user->id);



/*
TODO
if user-id(order) is the same as id(user) get username
if orders(order-id) == productsorders(order-id)

*/

$canceled_orders = [];
$sent_orders = [];
$pending_orders = [];

foreach ($orders as $order) {
    if ($order->status == 'Canceled') {
        array_push($canceled_orders, $order);
    } elseif ($order->status == 'Sent') {
        array_push($sent_orders, $order);
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
                    <h1 class="color-green"><?= count($sent_orders) ?></h1>
                    <p>Total Sent</p>
                </div>
                <div class="tracking">
                    <h1 class="color-blue"><?= count($pending_orders) ?></h1>
                    <p>Pending Orders</p>
                </div>
                <div class="tracking">
                    <h1 class="color-red"><?= count($canceled_orders) ?></h1>
                    <p>Orders Canceled</p>
                </div>
            </div>
            <div class="orders">
                <table class="m-t-50" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Order Date</th>
                            <th class="th-status">Status</th>
                            <th class="th-edit">Edit</th>
                            <th class="th-save">Status</th>
                            <th class="th-delete">Delete</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <form action="/exa/admin-scripts/post-update-order.php" method="post">
                                    <td>#<input type="hidden" name="id" value="<?= $order->id ?>"><?= $order->id ?></td>
                                    <td>#<?= $order->user_id ?></td>
                                    <!-- <td><?= $username_by_id->username ?></td> -->



                                    <td><?= $order->order_date ?></td>

                                    <td class="td-status">
                                        <span class="order 
                                        <?php
                                        if ($order->status === "Pending") {
                                            echo "pending";
                                        } elseif ($order->status === "Sent") {
                                            echo "sent";
                                        } elseif ($order->status === "Canceled") {
                                            echo "canceled";
                                        } ?>
                                        ">
                                            <?= $order->status ?>
                                        </span>
                                    </td>
                                    <td class="td-edit th-edit-role">

                                        <select name="status" id="status">
                                            <option value="status" selected disabled>Change status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Sent">Sent</option>
                                            <option value="Canceled">Canceled</option>
                                        </select>

                                    </td>
                                    <td class="td-save">
                                        <button type="submit" class="reset-btn-styling"><i class='bx bx-save'></i></button>
                                    </td>

                                </form>
                                <td class="td-delete">
                                    <form action="/exa/admin-scripts/post-delete-order.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $order->id ?>">
                                        <button type="submit" class="reset-btn-styling"><i class='bx bx-trash'></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>