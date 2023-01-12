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

$time = time();

$numDay = date('d', $time);
$numMonth = date('m', $time);
$strMonth = date('F', $time);
$numYear = date('Y', $time);
$firstDay = mktime(0, 0, 0, $numMonth, 1, $numYear);
$daysInMonth = cal_days_in_month(0, $numMonth, $numYear);
$dayOfWeek = date('w', $firstDay);

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
                <div class="col-14 m-h-1">
                    <div class="welcome">
                        <div class="welcome-text color-white">
                            <h2 class="m-b-1">Hello <?= $logged_in_user->username ?>!</h2>
                            <?php if ($order_count == 0) : ?>
                                <p>There is no new orders yet. &#128532; </p>
                            <?php endif; ?>
                            <?php if ($order_count == 1) : ?>
                                <p> You have <?= $order_count ?> new order. &#129395;</p>
                                <a href="/exa/pages/admin-orders.php" class="text-underline color-white">Manage orders</a>
                            <?php endif; ?>
                            <?php if ($order_count > 1) : ?>
                                <p> You have <?= $order_count ?> new orders. It is a lot of work for today!
                                    So let's start. &#129395; </p>
                                <a href="/exa/pages/admin-orders.php" class="text-underline color-white">Manage orders</a>
                            <?php endif; ?>
                        </div>
                        <div class="welcome-image">
                            <img src="/exa/assets/img/illustrations/pink_girl.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-10 m-h-1">

                    <table class="calendar">
                        <caption><? echo ($strMonth); ?></caption>
                        <thead>
                            <tr>
                                <th abbr="Sunday" scope="col" title="Sunday">S</th>
                                <th abbr="Monday" scope="col" title="Monday">M</th>
                                <th abbr="Tuesday" scope="col" title="Tuesday">T</th>
                                <th abbr="Wednesday" scope="col" title="Wednesday">W</th>
                                <th abbr="Thursday" scope="col" title="Thursday">T</th>
                                <th abbr="Friday" scope="col" title="Friday">F</th>
                                <th abbr="Saturday" scope="col" title="Saturday">S</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                if (0 != $dayOfWeek) {
                                    echo ('<td colspan="' . $dayOfWeek . '"> </td>');
                                }
                                for ($i = 1; $i <= $daysInMonth; $i++) {

                                    if ($i == $numDay) {
                                        echo ('<td id="today">');
                                    } else {
                                        echo ("<td>");
                                    }
                                    echo ($i);
                                    echo ("</td>");
                                    if (date('w', mktime(0, 0, 0, $numMonth, $i, $numYear)) == 6) {
                                        echo ("</tr><tr>");
                                    }
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</section>