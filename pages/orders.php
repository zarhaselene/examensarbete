<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$logged_in_user = $_SESSION["user"];

$orders_db = new OrdersDatabase();
// $users_db = new UsersDatabase();

// $users = $users_db->get_all();

$orders = $orders_db->get_order_by_user_id($logged_in_user->id);

Template::header("Orders page");
?>

<h2>My orders</h2>

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
<?php endforeach;



Template::footer();
