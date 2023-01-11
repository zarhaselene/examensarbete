<?php
require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . '/../classes/UsersDatabase.php';

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && $logged_in_user->role == 'admin';

if (!$is_admin) {
    http_response_code(401);
    die('Access denied');
}

$users_db = new UsersDatabase();
$users = $users_db->get_all();

Template::header("Admin Dashboard");
?>

<section class="dashboard">
    <?php
    Template::sidebar();

    ?>
    <div class="admin-dashboard display-flex align-items-center justify-center">
        <div class="admin-container">
            <h2 class="heading">Users</h2>
            <div class="admin-top-container-create ">
                <div class="create">
                    <form class="create-form display-flex align-items-center" action="/exa/admin-scripts/post-create-user.php" method="post" enctype="multipart/form-data">
                        <input type="text" id="username" name="username" placeholder="Username.." required>
                        <input type="password" name="password" placeholder="Password.." required><br>
                        <input type="password" name="confirm-password" placeholder="Confirm password.." required><br>
                        <select id="role" name="role">
                            <optgroup>
                                <option disabled selected>Set role</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </optgroup>
                        </select>
                        <input type="submit" value="Create new user">
                    </form>
                </div>
            </div>

            <div class="users">
                <table class="m-t-50" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="th-edit">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td>#<?= $user->id ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->role ?></td>
                                <td class="td-edit"><a href=""><i class='bx bxs-edit color-grey'></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

</section>