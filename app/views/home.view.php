<?php

class HomeView extends ControllerAbs{
	
	public function showHome(){
		
		require 'templates/home.phtml';
	}

	public function showError($error){
		require 'templates/error.phtml';
	}
}
