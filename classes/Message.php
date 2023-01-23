<?php
class Message
{
    public $id;
    public $name;
    public $email;
    public $message;
    public $date;
    public $status;

    public function __construct($name, $email, $message, $date, $status, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->date = $date;
        $this->status = $status;
    }
}
