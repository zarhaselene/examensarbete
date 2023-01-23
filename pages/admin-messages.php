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

            <div class="messages-container">
                <div class="messages">
                    <?php foreach ($messages as $message) : ?>
                        <div class="message">
                            <div class="message-info display-flex align-items-center justify-between">
                                <div class="display-flex direction-column justify-center align-items-start">
                                    <p>#<?= $message->id ?></p>
                                    <small>From: <?= $message->name ?></small>
                                </div>
                                <div class="display-flex direction-column justify-center align-items-end">
                                    <p><?= $message->status ?></p>
                                    <small class="color-darkgrey"><?= $message->date ?></small>
                                </div>
                            </div>
                            <div class="message-msg p-t-2 p-b-6">
                                <p><?= substr($message->message, 0, 100) ?>...</p>
                            </div>
                            <div class="message-link display-flex justify-end">
                                <a class="color-pink see-more" href="/exa/pages/admin-message.php?id=<?= $message->id ?>">See more</a>
                            </div>

                            <div class="message-delete display-flex justify-start">
                                <form action="/exa/admin-scripts/post-delete-message.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $message->id ?>">
                                    <button type="submit" class="reset-btn-styling"><i class='bx bx-trash color-black'></i></button>
                                </form>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>