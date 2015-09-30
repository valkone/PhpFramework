<?php

namespace Framework\Models;

class UserModel {

    private $users = [
        1 => [
            "name" => "<h1>Ivan</h1>",
            "email" => "ivan@abv.bg"
        ],
        2 => [
            "name" => "Dragan",
            "email" => "dragan@abv.bg"
        ],
        3 => [
            "name" => "Petkan",
            "email" => "petkan@abv.bg"
        ],
        4 => [
            "name" => "Stoqn",
            "email" => "stoqn@abv.bg"
        ]
    ];

    public function getAll() {
        $users = [];
        foreach($this->users as $user) {
            $users[] = new User($user["name"], $user["email"]);
        }

        return  $users;
    }

    public function getOne($id) {
        $user = $this->users[$id];

        return new User($user["name"], $user["email"]);
    }
}