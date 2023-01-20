<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../google-config.php";
require_once __DIR__ . "/../classes/Template.php";

$google_login_btn = '<a href="' . $google_client->createAuthUrl() . '"><img src="/exa/assets/img/btn_google_signin_light.png" /></a>';

Template::header("Login");
?>
<section class="login">
    <div class="container row">
        <div class="lr-wrapper col-16">
            <div class="lr-logo">
                <a href="/exa/index.php"> <img src="/exa/assets/img/logos/logo.png" alt="logo"></a>
            </div>
            <div class="lr-container display-flex direction-column align-items-center justify-center">
                <div class="heading m-z">
                    <h2>Login to Your Account</h2>
                </div>
                <div class="google p-t-3">
                    <p>Login using your Google account</p>
                    <div class="google-btn p-t-2 display-flex direction-column align-items-center">
                        <?= $google_login_btn ?>
                    </div>
                </div>
                <div class="lr-form p-t-3">
                    <p class="line"><span class="or color-grey">OR</span></p>
                    <form action="/exa/scripts/post-login.php" method="POST" class="form">

                        <div class="username position-relative display-flex direction-column">
                            <input type="text" name="username" placeholder="Username..">
                            <i class="fa fa-user fa-lg color-pink position-absolute"></i>
                            <br>
                        </div>
                        <div class="password position-relative display-flex direction-column ">
                            <input type="password" name="password" placeholder="Password..">
                            <i class="fa-solid fa-lock color-pink position-absolute"></i>
                            <br>
                            <button type="submit" class="btn full-btn m-z">Login</button>
                        </div>

                        <?php
                        if (isset($_GET['error'])) {
                            echo '<p id="invalid-credentials">Invalid credentials. Please try again.</p>';
                        }
                        ?>
                    </form>

                </div>
            </div>
        </div>
        <div class="lr-small-wrapper col-8 position-relative">
            <div class="floaties">
                <div class="rectangle-shape small"></div>
                <div class="circle-shape large"></div>
            </div>
            <div class="lr-small-container color-white text-center display-flex direction-column align-items-center justify-center">
                <div class="heading">
                    <h2>New Here?</h2>
                </div>
                <p>Sign up and discover a great amount of new opportunities!</p>
                <a href="/exa/pages/register.php" class="regi-btn btn full-btn">Sign up</a>

            </div>
        </div>
    </div>
</section>