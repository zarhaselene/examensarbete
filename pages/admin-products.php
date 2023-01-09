<?php
require_once __DIR__ . '/../classes/Template.php';

// require_once __DIR__ . "/../classes/User.php";
// require_once __DIR__ . "/../classes/Order.php";

require_once __DIR__ . '/../classes/ProductsDatabase.php';
// require_once __DIR__ . '/../classes/UsersDatabase.php';
// require_once __DIR__ . '/../classes/OrdersDatabase.php';

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && $logged_in_user->role == 'admin';

if (!$is_admin) {
    http_response_code(401);
    die('Access denied');
}

$products_db = new ProductsDatabase();
// $users_db = new UsersDatabase();
// $orders_db = new OrdersDatabase();


// $users = $users_db->get_all();
$products = $products_db->get_all();
// $orders = $orders_db->get_all_orders();


Template::header("Admin Dashboard");
?>

<section class="dashboard">
    <?php
    Template::sidebar();

    ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container">
            <h2 class="heading">Products</h2>
            <div class="admin-top-container">
                <div class="create">
                    <form class="create-form display-flex align-items-center" action="/exa/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
                        <input type="text" id="title" name="title" placeholder="Product title..">
                        <input type="number" name="price" placeholder="Price.."><br>
                        <input id="description" name="description" placeholder="Description..">
                        <input type="file" name="image" accept="image/*"><br>
                        <input type="submit" value="Add new product">
                    </form>
                </div>
            </div>

            <div class="products">
                <?php foreach ($products as $product) : ?>
                    <ul>
                        <li>
                            <a href="/exa/pages/admin-product.php?id=<?= $product->id ?>">
                                <?= $product->title ?></a>
                        </li>
                    </ul>
                <?php endforeach; ?>
            </div>
        </div>

</section>