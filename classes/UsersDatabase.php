<?php
require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/User.php";

class UsersDatabase extends Database
{

    // Get one by username
    public function get_one_by_username($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param('s', $username);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_user = mysqli_fetch_assoc($result);

        $user = null;

        if ($db_user) {
            $user = new User($db_user['username'], $db_user['role'], $db_user['firstname'], $db_user['lastname'], $db_user['email'], $db_user['id']);
            $user->set_password_hash($db_user['password-hash']);
        }
        return $user;
    }

    // Get one by id
    public function get_user_by_id($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_user = mysqli_fetch_assoc($result);

        $user = null;

        if ($db_user) {
            $user = new User($db_user['username'], $db_user['role'], $db_user['firstname'], $db_user['lastname'], $db_user['email'], $db_user['id']);
            $user->set_password_hash($db_user['password-hash']);
        }
        return $user;
    }

    // Get five users
    public function get_five()
    {
        $query = "SELECT * FROM users ORDER BY ID DESC LIMIT 5";
        $result = mysqli_query($this->conn, $query);
        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($db_users as $db_user) {
            $user = new User($db_user['username'], $db_user['role'], $db_user['firstname'], $db_user['lastname'], $db_user['email'], $db_user['id']);
            $users[] = $user;
        }
        return $users;
    }

    // Get all
    public function get_all()
    {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query);
        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($db_users as $db_user) {
            $user = new User($db_user['username'], $db_user['role'], $db_user['firstname'], $db_user['lastname'], $db_user['email'], $db_user['id']);
            $users[] = $user;
        }
        return $users;
    }

    // Create user
    public function create(User $user)
    {
        $query = "INSERT INTO users (username, `password-hash`, `role`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);

        $username = $user->username;
        $password_hash = $user->get_password_hash();
        $role = $user->role;


        $stmt->bind_param("sss", $username, $password_hash, $role);

        $success = $stmt->execute();
        $user_id = $this->conn->insert_id;

        if ($success) {
            return $user_id;
        } else {
            return false;
        }
    }
    // Update user role
    public function update($role, $id)
    {
        $query = "UPDATE users SET `role` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $role, $id);

        $success = $stmt->execute();

        return $success;
    }
    // Update username
    public function update_my_username(User $user, $id)
    {
        $query = "UPDATE `users` SET `username` = ? WHERE `users`.`id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("si", $user->username, $id);

        return $stmt->execute();
    }

    // Update account information
    public function update_account(User $user, $id)
    {
        $query = "UPDATE `users` SET `firstname` = ?, `lastname` = ?, `email` = ? WHERE `users`.`id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("sssi", $user->firstname, $user->lastname, $user->email, $id);

        return $stmt->execute();
    }

    // Delete user
    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $success = $stmt->execute();

        return $success;
    }
    // Get or Create user from google login 
    public function get_google_user(User $user)
    {
        $db_user = $this->get_one_by_username($user->username);

        if ($db_user === null) {
            $query = "INSERT INTO users (username, `role`) VALUES (?, ?)";

            $stmt = mysqli_prepare($this->conn, $query);
            $username = $user->username;
            $role = $user->role;

            $stmt->bind_param("ss", $username, $role);
            $success = $stmt->execute();

            if ($success) {
                $user = $this->get_user_by_id($stmt->insert_id);
            } else {

                var_dump($stmt->error);
                die("Error");
            }
        } else {
            $user = $db_user;
        }

        return $user;
    }
}
