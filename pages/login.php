<?php
require_once __DIR__ . "/../classes/Template.php";

Template::header("Matley - Login");
if (isset($_GET['register']) && $_GET['register'] == 'success') {
    echo '<h2 id="success-msg">User created, please log in!</h2>';
}
?>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') : ?>
    <br>
    <p class="invalid-credentials">Invalid username or password!</p>
<?php endif; ?>

<div class="login-container" style="padding-top:500px">
    <form action="/exa/scripts/post-login.php" method="post">
        <div class="username">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username.."><br>
        </div>
        <div class="password">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password.."> <br>
            <input type="submit" value="Login">
        </div>
        <div class="reg-link">
            <p> Don't have an account? Register <a href="/exa/pages/register.php"> here</a></p>

        </div>
    </form>
</div>