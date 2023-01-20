<?php
require_once __DIR__ . "/User.php";

/* Adding this to include the session variable correctly */
require_once __DIR__ . "/../google-config.php";

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

            <!-- Stripe -->
            <script src="https://js.stripe.com/v3/" defer></script>

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

            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
            <!-- JS -->
            <script src="/exa/assets/script.js" defer></script>

        </head>

        <body>
        <?php
    }
    public static function navbar()
    {
        $is_logged_in = isset($_SESSION['user']);
        $logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
        $is_admin = $is_logged_in && $logged_in_user->role == 'admin';

        // $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        ?>
            <nav class="navigation row display-flex p-v-2">
                <div class="logo col-4 col-12-tablet display-flex align-items-center">
                    <a href="/exa/index.php"> <img src="/exa/assets/img/logos/logo.png" alt="logo"></a>
                </div>

                <div class="icons col-20 col-12-tablet display-flex align-items-center justify-end">

                    <!-- If not logged in -->
                    <?php if (!$is_logged_in) : ?>
                        <div class="login" id="login-button">
                            <a href="/exa/pages/login.php"><i class="icon fa-solid fa-user color-white"></i></a>
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
                        <div class="account"><a href="/exa/pages/orders.php" class="color-white"><i class="icon fa-solid fa-user color-white"></i></a></div>

                    <?php endif; ?>

                    <!-- Always show -->
                    <span id="message"></span>
                    <div class="cart">
                        <a href="/exa/pages/cart.php" class="color-white">
                            <i class="icon fa-solid fa-basket-shopping color-white"></i>
                            <div id="circle" class="basket-circle justify-center align-items-center">
                                <span id="cart-count"></span>
                            </div>
                        </a>
                    </div>

                </div>

            </nav>

        <?php
    }

    public static function sidebar()

    {
        $is_logged_in = isset($_SESSION['user']);
        $logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

        //Get first letter of username
        $username = $logged_in_user->username;
        $first_letter = substr($username, 0, 1);

        ?>
            <div class="sidebar">

                <i class='sb-icon bx bx-menu' id="open-btn" onclick="toggleSidebar()"></i>

                <ul class="sidebar-list">
                    <li>
                        <a href="/exa/pages/admin.php" class="sidebar-list-item">
                            <i class='bx bx-grid-alt'></i>
                            <span class="sb-links-name">Dashboard</span>
                        </a>
                        <span class="tooltip">Dashboard</span>
                    <li>
                        <a href="/exa/pages/admin-products.php" class="sidebar-list-item">
                            <i class='bx bx-purchase-tag-alt'></i>
                            <span class="sb-links-name">Products</span>
                        </a>
                        <span class="tooltip">Products</span>
                    </li>
                    </li>
                    <li>
                        <a href="/exa/pages/admin-orders.php" class="sidebar-list-item">
                            <i class='bx bx-cart-alt'></i>
                            <span class="sb-links-name">Orders</span>
                        </a>
                        <span class="tooltip">Orders</span>
                    </li>
                    <li>
                        <a href="/exa/pages/admin-users.php" class="sidebar-list-item">
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
                        <div class="profile-image text-uppercase">
                            <?= $first_letter  ?>
                        </div>
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

                <!-- Swiper JS -->
                <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

            </footer>
        </body>

        </html>
<?php
    }
}
