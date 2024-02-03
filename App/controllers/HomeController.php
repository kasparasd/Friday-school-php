<?php

namespace App\controllers;

use App\App;
use App\DB\MariaBase;

class HomeController
{
    public function index()
    {
        $users = (new MariaBase('users'))->showAll();
        return App::view('home/index', [
            'title' => 'Home',
            'users'=>$users
        ]);
    }
}
