<?php

namespace Framework\Controllers;

use Framework\Models\UsersModels;
use Framework\View;

class AdministratorController {

    /**
     * @return View
     * @admin
     */
    public function banUser() {
        if(isset($_POST['banButton'])) {
            $user = $_POST['username'];

            $userModel = new UsersModels();
            $userModel->banUser($user);
        }

        return new View();
    }

    /**
     * @admin
     */
    public function banIp() {
        if(isset($_POST['banButton'])) {
            $ip = $_POST['ip'];

            $userModel = new UsersModels();
            $userModel->banIp($ip);
        }
        return new View();
    }
}