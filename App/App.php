<?php

namespace App;

use App\controllers\HomeController;
use App\controllers\LoginController;
use App\controllers\AdminController;
use App\controllers\UserController;

class App
{

    public static function run()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $route = array_slice($url, 3);

        return self::route($route);
    }


    private static function route($url)
    {
        if (count($url) == 1 && $url[0] == '') {
            return (new HomeController)->index();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == 'login') {
            return (new LoginController)->index();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 1 && $url[0] == 'login') {
            return (new LoginController)->login($_POST);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 1 && $url[0] == 'logout') {
            return (new LoginController)->logout();
        }
        if (Auth::get()->getStatus()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == 'profile') {
                return (new UserController)->profile();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 1 && $url[0] == 'updateDetails') {
                return (new UserController)->updateDetails($_POST);
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 1 && $url[0] == 'updatePassword') {
                return (new UserController)->updatePassword($_POST);
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 1 && $url[0] == 'deleteAccount') {
                return (new UserController)->deleteAccount($_POST);
            }
        }
        if (Auth::get()->getStatus() && Auth::get()->getStatus()->role == 'admin') {

            if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == 'users') {
                return (new AdminController)->users();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == 'createUser') {
                return (new AdminController)->create();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 1 && $url[0] == 'store') {
                return (new AdminController)->store($_POST);
            }
        }
        return App::view('404');
    }

    public static function view($view, $data = [])
    {
        extract($data);
        ob_start();
        $user = Auth::get()->getStatus();
        $message = Message::get()->isMsgSet();
        require ROOT . "./views/top.php";
        require ROOT . "./views/nav.php";
        require ROOT . "./views/$view.php";
        require ROOT . "./views/bottom.php";
        $content = ob_get_clean();
        return $content;
    }

    public static function redirect($url)
    {
        header('Location: ' . URL . $url);
        exit;
    }
}
