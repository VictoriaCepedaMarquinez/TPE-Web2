<?php

class AuthHelper {

    function __construct() {
        session_start();
    }

    public function login($user) {
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_NAME'] = $user->nombre;
        $_SESSION['ADMIN'] = $user->admin; 
    }
    
    public function verifyAdmin(){
        if (isset($_SESSION['USER_ID']) && ($_SESSION['ADMIN'] === 0)) {
            header('Location: ' . BASE_URL );
        }
    }
    
    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
    }

    public function verify() {
        if (!isset($_SESSION['USER_ID'])) {
            $this->logout();
        }
    }
}
