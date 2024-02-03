<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
define('ROOT', __DIR__ . '/../');
define('URL', 'http://localhost/php-school/public/');

require ROOT . '/vendor/autoload.php';


use App\App;
use App\Auth;
use App\Message;

Auth::get();
echo App::run();
Message::get();
