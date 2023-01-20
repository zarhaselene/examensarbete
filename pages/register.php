<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../google-config.php";
require_once __DIR__ . "/../classes/Template.php";

$google_login_btn = '<a href="' . $google_client->createAuthUrl() . '"><img src="/exa/assets/img/btn_google_signin_light.png" /></a>';

Template::header("Register");
?>
<section class="register">
    <div class="container row">
        <div class="lr-wrapper col-16">
            <div class="lr-logo">
                <a href="/exa/index.php"> <img src="/exa/assets/img/logos/logo.png" alt="logo"></a>
            </div>
            <div class="lr-container display-flex direction-column align-items-center justify-center">
                <div class="heading m-z">
                    <h2>Create Account</h2>
                </div>

                <div class="lr-form p-t-3">
                    <div class="form-container" id="registerForm">
                        <form action="/exa/scripts/post-register-user.php" method="post" class="form">
                            <button type="button" class="popup-close reset-btn-styling"">
                                <i class=" p-z icon fa-solid fa-xmark color-white"></i>
                            </button>
                            <div class="username position-relative display-flex direction-column">
                                <input type="text" id="username" name="username" placeholder="Username..">
                                <i class="fa fa-user fa-lg color-pink position-absolute"></i>
                                <br>
                            </div>
                            <div class="password position-relative display-flex direction-column">
                                <input type="password" name="password" placeholder="Password..">
                                <i class="fa-solid fa-lock color-pink position-absolute" style="padding-top: 5px;"></i>
                                <br>
                            </div>
                            <div class="confirm-password position-relative display-flex direction-column">
                                <input type="password" name="confirm-password" placeholder="Confirm password.."><br>
                                <i class="fa-solid fa-circle-check color-pink position-absolute"></i>
                                <button type="submit" class="btn full-btn m-z">Register</button>
                            </div>
                            <?php
                            if (isset($_GET['register']) && $_GET['register'] == 'success') {
                                echo '<p id="success-msg">User created, please <a href="/exa/pages/login.php" class="text-underline">log in!</a> </p>';
                            }
                            ?>
                            <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_register') {
                                echo '<p id="invalid-credentials" class="p-t-2">Error creating user, try again.</p>';
                            }
                            ?>
                            <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_register_username') {
                                echo '<p id="invalid-credentials" class="p-t-2">Username taken, try again.</p>';
                            }
                            ?>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="lr-small-wrapper col-8 position-relative">
            <div class="floaties">
                <div class="rectangle-shape small"></div>
                <div class="circle-shape large"></div>
            </div>
            <div class="lr-small-container color-white text-center display-flex direction-column align-items-center justify-center">
                <div class="heading ">
                    <h2>Already have an account?</h2>
                </div>
                <p> Ipsa voluptas reiciendis tempora. Totam voluptatum nesciunt ab ipsum, odit perspiciatis.
                </p>
                <a href="/exa/pages/login.php" class="regi-btn btn full-btn">Login</a>
            </div>
        </div>
    </div>
</section>