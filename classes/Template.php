<?php
require_once __DIR__ . "/User.php";
session_start();

class Template
{
    public static function header($title)
    {
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
            <!-- Boxicons CSS -->
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

            <!-- Swiper's CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        </head>

        <body>
        <?php
    }
    public static function navbar()
    {
        $is_logged_in = isset($_SESSION['user']);
        $logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
        $is_admin = $is_logged_in && $logged_in_user->role == 'admin';

        $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        ?>
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
                        <div class="form-container" id="loginForm">
                            <form action="/exa/scripts/post-login.php" method="post" class="form">
                                <button type="button" class="popup-close reset-btn-styling" onclick="closeLoginForm()">
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
                                <div class="reg-link text-center p-t-2">
                                    <p> Don't have an account? Register <span class="color-pink text-underline" onclick="openRegisterForm()"> here</span></p>
                                </div>
                                <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
                                    echo '<p id="invalid-credentials">Invalid username or password!</p>';
                                }
                                ?>
                            </form>
                        </div>

                        <div class="form-container" id="registerForm">
                            <form action="/exa/scripts/post-register-user.php" method="post" class="form">
                                <button type="button" class="popup-close reset-btn-styling" onclick="closeRegisterForm()">
                                    <i class="p-z icon fa-solid fa-xmark color-white"></i>
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
                                    <button type="submit" class="btn full-btn m-z">Register</button>
                                </div>
                                <?php
                                if (isset($_GET['register']) && $_GET['register'] == 'success') {
                                    echo '<p id="success-msg">User created, please log in!</p>';
                                }
                                ?>
                                <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_register') {
                                    echo '<p id="invalid-credentials" class="p-t-2">Error saving user, try again.</p>';
                                }
                                ?>
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

    public static function sidebar()

    {
        $is_logged_in = isset($_SESSION['user']);
        $logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
        ?>
            <div class="sidebar open">

                <i class='bx bx-menu' id="open-btn"></i>

                <ul class="sidebar-list">
                    <li>
                        <a href="/exa/pages/admin.php" class="sidebar-list-item">
                            <i class='bx bx-grid-alt'></i>
                            <span class="sb-links-name">Dashboard</span>
                        </a>
                        <span class="tooltip">Dashboard</span>
                    </li>
                    <li>
                        <a href="/exa/pages/admin-orders.php" class="sidebar-list-item">
                            <i class='bx bx-cart-alt'></i>
                            <span class="sb-links-name">Orders</span>
                        </a>
                        <span class="tooltip">Orders</span>
                    </li>
                    <li>
                        <a href="#" class="sidebar-list-item">
                            <i class='bx bx-user'></i>
                            <span class="sb-links-name">Users</span>
                        </a>
                        <span class="tooltip">Users</span>
                    </li>
                    <li>
                        <a href="#" class="sidebar-list-item">
                            <i class='bx bx-chat'></i>
                            <span class="sb-links-name">Messages</span>
                        </a>
                        <span class="tooltip">Messages</span>
                    </li>

                    <li class="profile">
                        <div class="profile-image">Z</div> <!-- Fix so the first letter of username changes -->
                        <div class="profile-details">
                            <div class="name"><?= $logged_in_user->username ?></div>
                        </div>
                        <a href="/exa/index.php"><i class='bx bx-log-out' id="log_out"></i></a>
                    </li>
                </ul>
            </div>

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
