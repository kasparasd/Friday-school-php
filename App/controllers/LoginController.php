<?php

namespace App\controllers;

use App\App;
use App\Auth;
use App\Message;

class LoginController
{
    public function index()
    {
        return App::view('auth/index');
    }
    public function login($data)
    {
        $user = Auth::get()->tryLogin($data);
        if ($user === 'deleted') {
            Message::get()->setMessage('danger', 'This account is deleted');
            App::redirect('login');
        } else if ($user) {
            App::redirect('');
        } else {
            Message::get()->setMessage('danger', 'Email or password is not correct');
            App::redirect('login');
        }
    }
    public function logout()
    {
        Auth::get()->logout();
        return App::redirect('');
    }
}
