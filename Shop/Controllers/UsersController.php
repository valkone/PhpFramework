<?php

namespace Framework\Controllers;

use Framework\DB;
use Framework\Models\UsersModels;
use Framework\View;

class UsersController {

    public function Login() {
        if(isset($_POST['loginButton'])) {
            echo 'OK';
        }
        return new View();
    }

    public function Register() {
        if(isset($_POST['registerButton'])) {
            $username = $_POST['username'];
            $pass= $_POST['pass'];
            $confirmPass = $_POST['confirmPass'];
            $email = $_POST['email'];

            $errors = [];

            if($pass != $confirmPass) {
                $errors[] = "The passwords does not match";
            }
            if($username > 30 || strlen($username) == 0) {
                $errors[] = "Invalid username";
            }
            if(strlen($email) > 60 || strlen($email) == 0) {
                $errors[] = "Invalid email";
            }

            if(count($errors) == 0) {
                $userModel = new UsersModels();

                try {
                    $userModel->register($username, $pass, $email);
                } catch(\Exception $e) {
                    $errors[] = $e->getMessage();
                }
            }

            View::$viewBag['errors'] = $errors;
        }
        return new View();
    }
}