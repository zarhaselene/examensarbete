<?php
require_once __DIR__ . "/User.php";
session_start();
class Template
{
    public static function header($title)
    {
        $is_logged_in = isset($_SESSION['user']);
        $logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
        $is_admin = $is_logged_in && $logged_in_user->role == 'admin';

        $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> <?= $title ?> </title>
            <link rel="stylesheet" href="/exa/assets/style.css">

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Varela+Round&display=swap" rel="stylesheet">

            <!-- Font Awesome -->
            <script src="https://kit.fontawesome.com/6310c3f0d1.js" crossorigin="anonymous"></script>

            <!-- Link Swiper's CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        </head>

        <body>
            <nav class="navigation row display-flex p-v-2">
                <div class="logo col-4 col-12-tablet display-flex align-items-center">
                    <a href="/exa/index.php"> <img src="/exa/assets/img/logos/logo.png" alt="logo"></a>
                </div>

                <div class="icons col-20 col-12-tablet display-flex align-items-center justify-end">

                    <!-- If not logged in -->
                    <?php if (!$is_logged_in) : ?>
                        <div class="login" onclick="openLoginForm()">
                            <i class="icon fa-solid fa-user color-white"></i>
                        </div>
                        <div class="login-container" id="loginForm">
                            <form action="/exa/scripts/post-login.php" method="post" class="login-form">
                                <button type="button" class="login-popup-close reset-btn-styling" onclick="closeLoginForm()">
                                    <i class="p-z icon fa-solid fa-xmark color-white"></i>
                                </button>

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
                                <div class="reg-link p-t-2">
                                    <p> Don't have an account? Register <a href="/exa/pages/register.php" class="color-pink"> here</a></p>
                                </div>
                            </form>
                        </div>

                    <?php endif; ?>

                    <!-- If logged in -->
                    <?php if ($is_logged_in) : ?>
                        <div class="logged-in-user hide-tablet display-flex">
                            <p>
                            <p class="color-white p-h-1">Logged in as: </p>
                            <p class="color-pink text-uppercase"> <?= $logged_in_user->username ?> </p>
                            <form class="logout-btn p-h-2" action="/exa/scripts/post-logout.php" method="post">
                                <button class="reset-btn-styling icon p-z color-white" type="submit">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </button>
                            </form>
                            </p>
                        </div>

                        <?php if ($is_admin) : ?>
                            <div class="dashboard"><a href="/exa/pages/admin.php"><i class="icon fa-solid fa-gear color-white"></i></a></div>

                        <?php endif; ?>
                        <div class="account"><a href="/exa/pages/account.php" class="color-white"><i class="icon fa-solid fa-user color-white"></i></a></div>

                    <?php endif; ?>

                    <!-- Always show -->
                    <div class="cart"><a href="/exa/pages/cart.php" class="color-white"><i class="icon fa-solid fa-basket-shopping color-white"></i> <span class="basket-circle"><?= $cart_count ?></span></a></div>
                </div>

            </nav>
        <?php
    }

    public static function footer()
    { ?>

            <footer class="display-flex align-items-center">
                <div class="content-large display-flex align-items-center justify-between">
                    <div class="footer-logo">
                        <img src="/exa/assets/img/logos/logo_black.png" alt="">
                    </div>
                    <div class="socials">
                        <p>Follow us</p>
                        <div class="sm-icons p-t-1">
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-pinterest"></i>
                        </div>
                    </div>

                </div>


            </footer>



            <!-- Swiper JS -->
            <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
            <!-- JS file -->
            <script src="/exa/assets/script.js"></script>

        </body>

        </html>
<?php
    }
}
