<?php
require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/MessagesDatabase.php';

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && $logged_in_user->role == 'admin';

if (!$is_admin) {
    http_response_code(401);
    die('Access denied');
}

$messages_db = new MessagesDatabase();
$messages = $messages_db->get_all();


Template::header("Admin Dashboard");
?>

<section class="dashboard">
    <?php
    Template::sidebar();

    ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container">
            <h2 class="heading">Messages</h2>

            <div class="products">

                <?php foreach ($messages as $message) : ?>

                    <div class="td-delete">
                        <form action="/exa/admin-scripts/post-delete-message.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $message->id ?>">
                            <button type="submit" class="reset-btn-styling"><i class='bx bx-trash color-black'></i></button>
                        </form>
                    </div>
                <?php endforeach; ?>

            </div>

</section>