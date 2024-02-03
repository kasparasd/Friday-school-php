<?php

namespace App;

use App\DB\MariaBase;

class Auth
{
    private static $userObject = null;
    private $userDetails = null;
    private $loginStatus = 0;

    // Su get mes arba sukuriam nauja objekta arba grazinam jau egzistuojanti
    public static function get()
    {
        return self::$userObject ?? self::$userObject = new self();
    }

    private function __construct()
    {
        if (isset($_SESSION['user']) && $_SESSION['login'] == 1) {
            $this->userDetails = $_SESSION['user'];
            $this->loginStatus = 1;
        }
    }

    public function tryLogin($data)
    {
        $writer = (new MariaBase('users'));

        $users = $writer->showAll();

        foreach ($users as $user) {
            if ($user->email == $data['email'] && $user->password == sha1($data['password'])) {
                if ($user->deleted) {
                    return 'deleted';
                }
                $this->set($user);
                return true;
            }
        }
        return false;
    }

    public function set($user)
    {
        $_SESSION['user'] = $user;
        $_SESSION['login'] = 1;
    }

    public function getStatus()
    {
        if ($this->loginStatus) {
            return $this->userDetails;
        };
        return false;
    }

    public function logout()
    {
        $_SESSION['user'] = '';
        $_SESSION['login'] = 0;
    }
}
