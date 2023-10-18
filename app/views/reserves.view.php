<?php

class ReserveView {

    public function showListReserves($reserves) {
        require 'templates/listReserves.phtml';  
    }

    public function showAddReserve($room, $rooms){
        require 'templates/formAddReserve.phtml';
    }

    public function showDetailReserve($reserve, $total){
        require 'templates/detailReserve.phtml';
    }

    public function showModificReserve($reserve, $rooms){
       require 'templates/formModificReserves.phtml';
    }

    public function showLastReserve($reserve, $total){
        require 'templates/detailReserve.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}
