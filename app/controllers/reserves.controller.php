<?php
require_once './app/models/reserves.model.php';
require_once './app/views/reserves.view.php';
require_once './app/helpers/auth.helper.php';
require_once './app/models/rooms.model.php';
require_once "base.controller.php";

class ReserveController extends ControllerAbs {
    private $roomsModel;
    private $model;
    private $view;

    public function __construct() {
        parent::__construct();
        $this->roomsModel = new RoomsModel();
        $this->model = new ReserveModel();
        $this->view = new ReserveView();   
        $this->auth_helper->verify();
    }

    public function addReserve() {
        $id_usuario =  $_SESSION['USER_ID'] ;
        $cant_noches = $_POST['cant_noches'];
        $id_habitacion= $_POST['id_habitacion'];
        // validaciones
        if (empty($cant_noches) || empty($id_habitacion)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $reserve = $this->model->insertReserve($id_usuario,$id_habitacion,$cant_noches);
        if ($id_usuario) {
            header('Location: ' . BASE_URL . 'yourReserve/'. $reserve->id);
        } else {
            $this->view->showError("Error al insertar la reserva");
        }
    }

    public function modificReserves($id) {
        $id_usuario =  $_SESSION['USER_ID'] ;
        $cant_noches = $_POST['cant_noches'];
        $id_habitacion= $_POST['id_habitacion'];
        
        if (empty($cant_noches) || empty($id_habitacion)) {
            $this->view->showError("Debe completar todos los campos para modificar la reserva");
            return;
        }
       $this->model->modificReserve($id,$id_usuario,$id_habitacion,$cant_noches);
       header('Location: ' . BASE_URL . 'yourReserve/' . $id);
    }

    public function confirmReserve($id){
       $this->model->updateReserve($id);
       header('Location: ' . BASE_URL . 'yourReserve/' . $id);
    }

    public function confirmReserveList($id){
        $this->model->updateReserve($id);
        header('Location: ' . BASE_URL . 'listReserves');
    }

    public function removeReserve($id){
        $this->model->deleteReserve($id);
        header('Location: ' . BASE_URL . 'rooms');
    }

    public function showLastReserve($id){
        $reserve = $this->model->getReserveById($id);
        $total =  $this->model->calculatePrice($reserve->id);
        $this->view->showLastReserve($reserve, $total);   
    }

    public function showDetailReserve($reserveId){
        $reserve = $this->model->getReserveAndRoomById($reserveId);
        $total =  $this->model->calculatePrice($reserve->id);
        $this->view->showDetailReserve($reserve, $total); 
    }

    public function showListReserves() {
        $reserves = $this->model->getReserves();
        $this->view->showListReserves($reserves);
    }

    public function showAddReserve($id){ 
        $rooms = $this->roomsModel->getRooms();
        $room = $this->model->getRoomById($id);
        $this->view->showAddReserve($room, $rooms);
    }

    public function showModificReserve($id){
        $reserve = $this->model->getReserveAndRoomById($id);
        $rooms = $this->roomsModel->getRooms();
        $this->view->showModificReserve($reserve, $rooms);
    }

}
