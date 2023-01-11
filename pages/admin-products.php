<?php
require_once __DIR__ . '/../classes/Template.php';
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

Template::header("Admin Dashboard");
?>

<section class="dashboard">
    <?php
    Template::sidebar();

    ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container">
            <h2 class="heading">Products</h2>
            <div class="admin-top-container-create ">
                <div class="create">
                    <form class="create-form display-flex align-items-center" action="/exa/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
                        <input type="text" id="title" name="title" placeholder="Product title.." required>
                        <input type="number" name="price" placeholder="Price.." required><br>
                        <input id="description" name="description" placeholder="Description.." required>
                        <input type="file" name="image" accept="image/*" required><br>
                        <input type="submit" value="Add new product">
                    </form>
                </div>
            </div>

            <div class="products">
                <table class="m-t-50" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th> Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <!-- <th class="th-status">Status</th> -->
                            <th class="th-edit">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>#<?= $product->id ?></td>
                                <td><?= $product->title ?></td>
                                <td><?= $product->description ?></td>
                                <td>$<?= $product->price ?></td>
                                <!-- <td class="td-status"><span class="red"><?= $order->status ?></span></td> -->
                                <td class="td-edit"><a href="/exa/pages/admin-edit-product.php?id=<?= $product->id ?>"><i class='bx bxs-edit color-grey'></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

</section>