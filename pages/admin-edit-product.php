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

if (!isset($_GET['id'])) {
    die('Invalid input');
}

$products_db = new ProductsDatabase();
$product = $products_db->get_one($_GET['id']);

Template::header("Update product"); ?>
<section class="dashboard">
    <?= Template::sidebar(); ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container display-flex direction-column align-items-center position-relative">
            <h2 class="heading">Edit <?= $product->title ?></h2>
            <?php
            if ($product == null) :
            ?>
                <h2>No product to edit</h2>
            <?php else : ?>
                <div class="admin-edit-product-container">
                    <form class="edit-product-form" action="/exa/admin-scripts/post-update-product.php?id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col-24-tablet display-flex direction-column">
                                <div class="add-product-info">
                                    <div class="form-item">
                                        <label for="title">
                                            <h3>Set title</h3>
                                        </label>
                                        <input type="text" id="title" name="title" value="<?= $product->title ?>">
                                    </div>
                                    <div class="form-item">
                                        <label for="price">
                                            <h3>Set price</h3>
                                        </label>
                                        <input type="number" name="price" value="<?= $product->price ?>">
                                    </div>
                                    <div class="form-item">
                                        <label for="description">
                                            <h3>Write a description</h3>
                                        </label>
                                        <textarea name="description" placeholder="Description"><?= $product->description ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-24-tablet display-flex direction-column justify-evenly align-items-start">
                                <label for="image">
                                    <h3>Choose a product image</h3>
                                </label>
                                <div class="holder position-relative">
                                    <i class='bx bx-image'></i>
                                    <img id="imgPreview" src="#" alt="" />
                                </div>
                                <div class="btns display-flex align-items-center">
                                    <label for="photo" class="upload-photo btn m-z full-btn display-flex align-items-center">
                                        <i class='bx bxs-image-add'></i> Choose file</label>
                                    <input id="photo" type="file" id="photo" name="image" accept="image/*" required>
                                    <div class="submit">
                                        <button type="submit" class="btn m-z full-btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            endif; ?>
        </div>
    </div>
</section>