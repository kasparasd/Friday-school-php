<?php

namespace App\controllers;

use App\DB\MariaBase;
use App\App;
use App\Message;

class AdminController
{
    public function users()
    {
        $allUsers = (new MariaBase('users'))->showAll();

        return App::view('admin/users', [
            'title' => 'All users',
            'users' => $allUsers
        ]);
    }
    public function create()
    {
        return App::view('admin/create', [
            'title' => 'Create new user'
        ]);
    }
    public function store($data)
    {
        $users = (new MariaBase('users'))->showAll();
        $errors = [];

        if ($data['password'] !== $data['password2']) {
            $errors[] = 'Passwords do not match';
        }
        if (strlen($data['name']) < 3) {
            $errors[] = 'Name should be longer than 3 symbols';
        }
        if (strlen($data['lastname']) < 3) {
            $errors[] = 'Lastname should be longer than 3 symbols';
        }
        if (strlen($data['password']) < 3) {
            $errors[] = 'Password should be longer than 3 symbols';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
          }

        foreach ($users as $user) {
            if ($user->email == $data['email']) {
                $errors[] = 'This email is already registered in our system';
            }
        }
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $_SESSION['data'] = [
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                'email' => $data['email']
            ];
            return App::view('admin/create');
        } else {
            (new MariaBase('users'))->create((object)$data);
            Message::get()->setMessage('success', 'New account created');
            App::redirect('createUser');
        }
    }
}
