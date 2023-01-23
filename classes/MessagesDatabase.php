<?php
require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Message.php";

class MessagesDatabase extends Database
{
    // Get one
    public function get_one($id)
    {
        $query = "SELECT * FROM messages WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_message = mysqli_fetch_assoc($result);
        $message = null;

        if ($db_message) {
            $message = new Message(
                $db_message["name"],
                $db_message["email"],
                $db_message["message"],
                $db_message["date"],
                $db_message["status"],
                $id
            );
        }
        return $message;
    }

    // Get all
    public function get_all()
    {
        $query = "SELECT * FROM messages ORDER BY ID DESC";
        $result = mysqli_query($this->conn, $query);
        $db_messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $messages = [];

        foreach ($db_messages as $db_message) {
            $db_id = $db_message['id'];
            $db_name = $db_message['name'];
            $db_email = $db_message['email'];
            $db_msg = $db_message['message'];
            $db_date = $db_message['date'];
            $db_status = $db_message['status'];


            $messages[] = new Message($db_name, $db_email, $db_msg, $db_date, $db_status, $db_id);
        }
        return $messages;
    }

    // Create
    public function create(Message $message)
    {
        $query = "INSERT INTO messages (`name`, email, `message`, `date`, `status`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("sssss", $message->name, $message->email, $message->message, $message->date, $message->status);
        $success = $stmt->execute();
        return $success;
    }

    //Update
    public function update($status, $id)
    {
        $query = "UPDATE messages SET `status` = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    // Delete
    public function delete($id)
    {
        $query = "DELETE FROM messages WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
