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
                    <h1 class="color-green">hej</h1>
                    <p>Total Delivered</p>
                </div>
                <div class="tracking">
                    <h1 class="color-blue">hej</h1>
                    <p>Pending Orders</p>
                </div>
                <div class="tracking">
                    <h1 class="color-red">hej</h1>
                    <p>Orders Hold</p>
                </div>
            </div>
            <div class="orders">
                <?php foreach ($orders as $order) : ?>
                    <div>
          
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>

</section>