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
            <h2>Edit Your Information</h2>
            <a href="/exa/pages/account.php" class="text-underline color-pink">Back</a>
            <div class="user-information">

                <form action="/exa/scripts/update-username.php" method="post">
                    <input type="text" id="username" class="user-info" required name="username" placeholder="Username" value="<?= $logged_in_user->username ?>">
                    <input type="hidden" name="id" value="<?= $logged_in_user->id; ?>">
                    <input type="submit" class="btn full-btn" value="Change username">
                </form>
                <form action="/exa/scripts/update-account.php" method="post">
                    <input type="text" id="firstname" class="user-info" required name="firstname" placeholder="First Name" value="<?= $logged_in_user->firstname ?>">
                    <input type="text" id="lastname" class="user-info" required name="lastname" placeholder="Last Name" value="<?= $logged_in_user->lastname ?>">
                    <input type="email" id="email" class="user-info" required name="email" placeholder="Email" value="<?= $logged_in_user->email ?>">
                    <input type="hidden" name="id" value="<?= $logged_in_user->id; ?>">
                    <input type="submit" class="btn full-btn" value="Update Info">
                </form>


            </div>
            <?php
            // $username 
            // $img_url
            // $email
            // $lastname
            // $firstname
            ?>
            <!-- Delete My account -->

        </div>
    </div>
</section>

<?
Template::footer();
