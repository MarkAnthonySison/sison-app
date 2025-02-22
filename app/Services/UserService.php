<?php

namespace App\Services;

class UserService {
    protected $users;

    public function __construct($users) {
        $this-> users = $users;
    }

    public function listusers() {
        return $this -> users;
    }
}

?>