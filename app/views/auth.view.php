<?php

class AuthView {
    public function showLogin($error = null) {
        require './templates/login.phtml';
    }

    public function showError($error){
		require 'templates/error.phtml';
	}
}
