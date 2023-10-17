<?php

class ReserveView {

    public function showReserves($reserves) {
        require 'templates/reserves.phtml';  
    }

    public function ShowReserve($room, $rooms){
        require 'templates/reserve.phtml';
    }

    public function showDetailReserve($reserve, $total){
        require 'templates/detailReserve.phtml';
    }

    public function showRoomByIdReserve($reserve, $rooms){
       require 'templates/form-reserves.phtml';
    }

    public function showLastReserve($reserve, $total){
        require 'templates/detailReserve.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}
