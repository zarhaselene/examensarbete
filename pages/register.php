<?php
require_once __DIR__ . '/../classes/Template.php';

Template::header("Matley - Register");
?>
<div class="register-container" style="padding-top:500px">
    <form action="/exa/scripts/post-register-user.php" method="post">
        <div class="username">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username..">
        </div>
        <div class="password">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password.."><br>
        </div>
        <div class="confirm-password">
            <label for="password">Confirm password</label>
            <input type="password" name="confirm-password" placeholder="Confirm password.."><br>
            <input type="submit" value="Register">
        </div>
    </form>
</div>