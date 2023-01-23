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
$message = $messages_db->get_one($_GET['id']);

Template::header("Admin Dashboard");
?>

<section class="dashboard">
    <?php
    Template::sidebar();
    ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container">
            <h2 class="heading">Message #<?= $message->id ?></h2>
            <div class="message-container">
                <form action="/exa/admin-scripts/post-update-message.php?id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="single-message display-flex direction-column">
                        <div class="message-info m-b-6 display-flex align-items-center justify-between">
                            <div class="name-email display-flex direction-column justify-center align-items-start">
                                <p>Name: <?= $message->name ?></p>
                                <p>Email: <?= $message->email ?></p>
                            </div>
                            <div class="status-sent display-flex direction-column justify-center align-items-end">
                                <p>Status: <?= $message->status ?></p>
                                <p>Sent: <?= $message->date ?></p>
                            </div>
                        </div>
                        <div class="single-msg">
                            <p><?= $message->message ?></p>
                        </div>
                        <div class="single-message-btns display-flex align-items-center justify-between">
                            <?php if ($message->status == "Read") : ?>
                                <input type="hidden" name="id" value="<?= $message->id ?>">
                                <input type="hidden" name="status" value="Unread">
                                <button type="submit" value="Unread" class="btn m-z full-btn mark-as">Mark as Unread</button>
                            <?php else : ?>
                                <input type="hidden" name="id" value="<?= $message->id ?>">
                                <input type="hidden" name="status" value="Read">
                                <button type="submit" value="Read" class="btn m-z full-btn mark-as">Mark as Read</button>
                            <?php endif; ?>
                            <a href="/exa/pages/admin-messages.php" class="btn m-z full-btn back">Go back </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</section>
