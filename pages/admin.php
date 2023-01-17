<?php
require_once __DIR__ . '/../classes/Template.php';

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Order.php";

require_once __DIR__ . '/../classes/ProductsDatabase.php';
require_once __DIR__ . '/../classes/UsersDatabase.php';
require_once __DIR__ . '/../classes/OrdersDatabase.php';

//Check if logged user is admin
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

$newest_users = $users_db->get_five();
$newest_orders = $orders_db->get_five();

$users = $users_db->get_all();
$products = $products_db->get_all();
$orders = $orders_db->get_all_orders();

$admins = [];
foreach ($users as $user) {
    if ($user->role == 'admin') {
        array_push($admins, $user);
    }
}
$admin_count = count($admins);

//To see how many new orders there is. All new orders have Pending as status
$pending_orders = [];
$sent_orders = [];
foreach ($orders as $order) {
    if ($order->status == 'Pending') {
        array_push($pending_orders, $order);
    } elseif ($order->status == 'Sent') {
        array_push($sent_orders, $order);
    }
}
$pending_count = count($pending_orders);
$sent_count = count($sent_orders);

//Calandar setup
$time = time();
$date = date('F Y');
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
                <div class="col-16 m-r-1 col-24-laptop">
                    <div class="welcome-banner">
                        <div class="welcome-text color-white">
                            <h2 class="m-b-1">Hello <?= $logged_in_user->username ?>!</h2>
                            <?php if ($pending_count == 0) : ?>
                                <p>There is no new orders yet. &#128532; </p>
                            <?php endif; ?>
                            <?php if ($pending_count == 1) : ?>
                                <p> You have <?= $pending_count ?> new order. &#129395;</p>
                                <a href="/exa/pages/admin-orders.php" class="text-underline color-white">Manage orders</a>
                            <?php endif; ?>
                            <?php if ($pending_count > 1) : ?>
                                <p> You have <?= $pending_count ?> new orders. It is a lot of work for today!
                                    So let's start. &#129395; </p>
                                <a href="/exa/pages/admin-orders.php" class="text-underline color-white">Manage orders</a>
                            <?php endif; ?>
                        </div>
                        <div class="welcome-image">
                            <img src="/exa/assets/img/illustrations/pink_girl.png" alt="">
                        </div>
                    </div>
                    <h2 class="heading m-z p-v-4">Progress overview</h2>
                    <div class="progress-overview">
                        <div class="progress display-flex align-items-center">
                            <p class="progress-count"><?= count($users) ?></p>
                            <div class="display-flex direction-column">
                                <a href="/exa/pages/admin-users.php" class="progress-total">
                                    <p class="progress-total"><b>Total users</b></p>
                                </a>
                                <span class="color-grey">(<?= $admin_count ?> admins)</span>
                            </div>
                        </div>
                        <div class="progress display-flex align-items-center">
                            <p class="progress-count"><?= count($orders) ?></p>
                            <div class="display-flex direction-column">
                                <a href="/exa/pages/admin-orders.php" class="progress-total">
                                    <p class="progress-total"><b>Total orders</b></p>
                                </a>
                                <span class="color-grey">(<?= $sent_count ?> orders sent)</span>
                            </div>
                        </div>
                        <div class="progress display-flex align-items-center">
                            <p class="progress-count"><?= count($products) ?></p>
                            <div class="display-flex direction-column">
                                <a href="/exa/pages/admin-products.php" class="progress-total">
                                    <p class="progress-total"><b>Total products</b></p>
                                </a> <span class="color-grey">( X products live)</span>
                            </div>

                        </div>
                        <div class="progress display-flex align-items-center">
                            <p class="progress-count">0</p>
                            <div class="display-flex direction-column">
                                <a href="/exa/pages/admin-messages.php" class="progress-total">
                                    <p class="progress-total"><b>Total messages</b></p>
                                </a> <span class="color-grey">( X messages answered)</span>
                            </div>

                        </div>

                    </div>
                    <div class="orders-overview m-v-4">
                        <div class="orders-heading p-b-2 display-flex align-items-center justify-between">
                            <h2>Newest orders</h2>
                            <button class="btn full-btn m-z">
                                <a href="/exa/pages/admin-orders.php" class=" color-white">See all</a>
                            </button>
                        </div>

                        <div class="orders-wrapper">
                            <div class="orders-top">
                                <div class="orders-headings">
                                    <p>Order ID</p>
                                    <p>Order Date</p>
                                    <p>Status</p>
                                </div>
                            </div>
                            <div class="orders-bottom">
                                <?php foreach ($newest_orders as $order) : ?>
                                    <p>#<input type="hidden" name="id" value="<?= $order->id ?>"><?= $order->id ?></p>
                                    <p><?= $order->order_date ?></p>
                                    <p><?= $order->status ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 m-l-1 hide-laptop">
                    <div class="calendar-wrapper position-relative display-flex align-items-center justify-center">
                        <p class="calendar-date color-black"> <b><?= $date ?></b> </p>
                        <table class="calendar">
                            <caption><? echo ($strMonth); ?></caption>
                            <thead>
                                <tr>
                                    <th abbr="Monday" scope="col" title="Monday">MON</th>
                                    <th abbr="Tuesday" scope="col" title="Tuesday">TUE</th>
                                    <th abbr="Wednesday" scope="col" title="Wednesday">WED</th>
                                    <th abbr="Thursday" scope="col" title="Thursday">THU</th>
                                    <th abbr="Friday" scope="col" title="Friday">FRI</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">SAT</th>
                                    <th abbr="Sunday" scope="col" title="Sunday">SUN</th>

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
                    <div class="users-overview m-t-4">
                        <div class="overview-heading p-b-2 display-flex align-items-center justify-between">
                            <h2>Newest Users</h2>
                            <a href="/exa/pages/admin-users.php" class="text-underline color-pink">see all</a>
                        </div>

                        <?php foreach ($newest_users as $user) :
                            $username = $user->username;
                            $first_letter = substr($username, 0, 1); ?>
                            <div class="profile-user display-flex align-items-center">
                                <div class="profile-image text-uppercase ">
                                    <?= $first_letter  ?>
                                </div>
                                <div class="profile-name text-capitalize">
                                    <p><?= $user->username ?></p>
                                </div>

                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>