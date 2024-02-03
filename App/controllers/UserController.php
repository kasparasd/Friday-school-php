<?php

namespace App\controllers;

use App\App;
use App\Auth;
use App\DB\MariaBase;
use App\Message;

class UserController
{
    public function profile()
    {
        return App::view('user/profile', [
            'title' => 'Profile'
        ]);
    }
    public function updateDetails($data)
    {
        $users = (new MariaBase('users'))->showAll();
        $updateError = [];
        foreach ($users as $user) {
            if ($user->email == $data['email']) {
                if ($user->id != $data['id']) {
                    $updateError[] = 'This email is already registered in our system';
                }
            }
        }
        if (count($updateError) > 0) {
            $_SESSION['updateError'] = $updateError;
            Message::get()->setMessage('danger', 'Your account update was unsuccessful');
            return App::redirect('profile');
        }
        (new MariaBase('users'))->update($data['id'], (object) $data);
        Auth::get()->set((object) $data);
        Message::get()->setMessage('success', 'Profile updated succesfully');

        return App::redirect('profile');
    }
    public function updatePassword($data)
    {
        $changePasswordError = [];

        $dbUser = (new MariaBase('users'))->show($data['id']);
        if ($dbUser->password !== sha1($data['oldpassword'])) {
            $changePasswordError[] = 'Old password is not correct';
        }
        if ($data['newpassword'] !== $data['newpassword2']) {
            $changePasswordError[] = 'Your new password do not match';
        }
        if (strlen($data['newpassword']) < 2) {
            $changePasswordError[] = 'New password must be longer than 3 symbols';
        }
        if (count($changePasswordError) > 0) {
            $_SESSION['changePasswordError'] = $changePasswordError;
            Message::get()->setMessage('danger', 'Password has not been changed');
            return App::redirect('profile');
        }
        (new MariaBase('users'))->updatePassword($data['id'], (object) $data);
        Message::get()->setMessage('success', 'Password successfully updated');
        return App::redirect('profile');
    }

    public function deleteAccount($data)
    {
        $deleteError = [];
        $dbUser = (new MariaBase('users'))->show($data['id']);
        if ($dbUser->password !== sha1($data['password'])) {
            $deleteError[] = 'Password is not correct. Account is not deleted';
        }
        if (count($deleteError) > 0) {
            $_SESSION['deleteError'] = $deleteError;
            Message::get()->setMessage('danger', 'Password is not correct. Account is not deleted');
            return App::redirect('profile');
        }
        (new MariaBase('users'))->deleteAccount($data['id']);
        Auth::get()->logout();
        Message::get()->setMessage('info', 'Your account has been deleted');
        return App::redirect('');
    }
}
