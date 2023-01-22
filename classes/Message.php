<?php
class Message
{
    public $id;
    public $name;
    public $email;
    public $message;
    public $date;

    public function __construct($name, $email, $message, $date, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->date = $date;
    }
}
