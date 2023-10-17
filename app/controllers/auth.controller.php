<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once "base.controller.php";

class AuthController extends ControllerAbs {

    private $view;
    private $model;

    function __construct() {
        parent::__construct();
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $name = $_POST['nombre'];
        $password = $_POST['password'];
       
        
        if (empty($name) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // busco el usuario
        $user = $this->model->getByName($name);
        if ($user && password_verify($password, $user->contraseña)) {
            // ACA LO AUTENTIQUE
            
            $this->auth_helper->login($user);
            
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }

    public function logout() {
        $this->auth_helper->logout();
        header('Location: ' . BASE_URL);    
    }
}
