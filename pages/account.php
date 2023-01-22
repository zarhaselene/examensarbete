<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$logged_in_user = $_SESSION["user"];

$username = $logged_in_user->username;
$role = $logged_in_user->role;
$firstname = $logged_in_user->firstname;
$lastname = $logged_in_user->lastname;
$email = $logged_in_user->email;


Template::header("My account "); ?>
<section class="my-account">
    <div class="go-back-container">
        <a class="go-back" href="/exa/index.php"> <i class='bx bx-arrow-back'></i> Continue shopping</a>

    </div>

    <div class="account-nav display-flex direction-column align-items-start justify-end">
        <div class="heading m-z display-flex align-items-center">
            <h2>Account settings</h2>

        </div>
        <div class="account-navbar">
            <ul class="display-flex align-items-center">
                <li>
                    <a href="/exa/pages/orders.php">Orders</a>
                </li>
                <li class="current">
                    <a href="#">Account</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="account-container">
        <div class="account">
            <h2>Your Information</h2>
            <p>View and update your information here.</p>
            <a href="/exa/pages/edit-account.php" class="text-underline color-pink">Edit</a>
            <div class="user-information">
                <p>Username: <?= $username ?> </p>
                <?php
                if (!$firstname) {
                    echo "<p>First name: Not added yet</p>";
                } else {
                    echo "<p>First name: $firstname</p>";
                }

                if (!$lastname) {
                    echo "<p>Last name: Not added yet</p>";
                } else {
                    echo "<p>Last name: $lastname</p>";
                }

                if (!$email) {
                    echo "<p>Email: Not added yet</p>";
                } else {
                    echo "<p>Email: $email</p>";
                }
                ?>
            </div>

            <!-- Delete My account -->
            <div>
                <p>Danger zone</p>
                <form action="/exa/scripts/delete-account.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $logged_in_user->id ?>">
                    <button type="submit" class="reset-btn-styling"><i class='bx bx-trash'>Delete my account</i></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?
Template::footer();
