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

            <div class="admin-top-container-create">
                <form class="create-form" action="/exa/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
                    <input type="text" id="title" name="title" placeholder="Product title.." required>
                    <input type="number" name="price" placeholder="Price.." required>
                    <input id="description" name="description" placeholder="Description.." required>
                    <input type="file" name="image" accept="image/*" required>
                    <input type="submit" value="Add new product">
                </form>
            </div>
            <div class="products">
                <table class="m-t-50" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th class="th-status">Edit</th>
                            <th class="th-delete">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <form action="/exa/admin-scripts/post-update-product.php" method="post" class="edit-form">
                                    <td>#<?= $product->id ?></td>
                                    <td><?= $product->title ?></td>
                                    <td>
                                        <img src="<?= $product->img_url ?>" alt="">
                                    </td>
                                    <td>
                                        <div class="td-desc">
                                            <?= $product->description ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-currency display-flex align-items-center">
                                            <span>$</span>
                                            <?= $product->price ?>.00
                                        </div>
                                    </td>
                                    <td class="td-edit">
                                        <a href="/exa/pages/admin-edit-product.php?id=<?= $product->id ?>">
                                            <i class=' bx bxs-edit color-black'></i>
                                        </a>
                                    </td>
                                </form>
                                <td class="td-delete">
                                    <form action="/exa/admin-scripts/post-delete-product.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $product->id ?>">
                                        <button type="submit" class="reset-btn-styling"><i class='bx bx-trash color-black'></i></button>
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