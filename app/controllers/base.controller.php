<?php

require_once './app/helpers/auth.helper.php';

abstract class ControllerAbs{

    protected $auth_helper;

    function __construct()
    {
        $this->auth_helper = new AuthHelper();
    }
    
}