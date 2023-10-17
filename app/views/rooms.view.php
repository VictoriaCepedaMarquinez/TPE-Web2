<?php

class RoomsView {
    public function showRooms($rooms) {
        require 'templates/descriptionRooms.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

    public function showRoomsAdmin($rooms){
        require 'templates/manageRooms.phtml';
    }

    public function showReservesByIdRoom($roomId, $roomSize){
        require 'templates/listReserveByCategory.phtml';
    }
}
