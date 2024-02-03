<?php

namespace App;

class Message
{
    private static $msgObject = null;
    private $msg = null;

    public static function get()
    {
        return self::$msgObject ?? self::$msgObject = new self;
    }

    private function __construct()
    {
        if (isset($_SESSION['message'])) {
            $this->msg = $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }

    public function setMessage($type, $msg)
    {
        $_SESSION['message'] = [
            'message' => $msg,
            'type' => $type
        ];
    }

    public function isMsgSet()
    {
       return $this->msg ?? false;
    }
}
