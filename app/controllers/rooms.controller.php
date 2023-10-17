<?php
require_once './app/models/rooms.model.php';
require_once './app/views/rooms.view.php';
require_once './app/helpers/auth.helper.php';
require_once "base.controller.php";

class RoomsController extends ControllerAbs {
    private $model;
    private $view;
    
    public function __construct() {
        parent::__construct();
        $this->view = new RoomsView();
        $this->model = new RoomsModel();
        
    }

    public function showRooms() {
        $rooms = $this->model->getRooms();
        $this->view->showRooms($rooms);
    }

    public function showRoomsAdmin(){
        $this->auth_helper->verify();
        $this->auth_helper->verifyAdmin();
        $rooms = $this->model->getRooms();
        $this->view->showRoomsAdmin($rooms);
    }

    public function addRoom(){
        $tamaño = $_POST['tamaño'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $imagen = $_FILES['imagen'];

        if (empty($tamaño) || empty($descripcion) || empty($precio) || empty($imagen['name']) || $imagen['error'] !== UPLOAD_ERR_OK) {
            $this->view->showError("Debe completar todos los campos y seleccionar una imagen válida.");
            return;
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = pathinfo($imagen['name'], PATHINFO_EXTENSION);

        if (!in_array($fileExtension, $allowedExtensions)) {
            $this->view->showError("El formato de la imagen no es válido. Se admiten solo imágenes JPG, JPEG, PNG y GIF.");
            return;
        }
        $uploadDirectory = 'images/';
        $newFileName = uniqid() . '.' . $fileExtension;

        if (!move_uploaded_file($imagen['tmp_name'], $uploadDirectory . $newFileName)) {
            $this->view->showError("Error al subir la imagen.");
            return;
        }

        $this->model->insertRooms($tamaño, $descripcion, $uploadDirectory . $newFileName, $precio);
        header('Location: ' . BASE_URL . 'showRooms');
    }


    public function updateRoom(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $tamaño = $_POST['tamaño'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];


            if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $imagen = $_FILES['imagen'];


                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = pathinfo($imagen['name'], PATHINFO_EXTENSION);

                if (!in_array($fileExtension, $allowedExtensions)) {
                    $this->view->showError("El formato de la imagen no es válido. Se admiten solo imágenes JPG, JPEG, PNG y GIF.");
                    return;
                }


                $uploadDirectory = 'images/';
                $newFileName = uniqid() . '.' . $fileExtension;

                if (!move_uploaded_file($imagen['tmp_name'], $uploadDirectory . $newFileName)) {
                    $this->view->showError("Error al subir la nueva imagen.");
                    return;
                }


                $imagen = $uploadDirectory . $newFileName;
            } else {

                $imagen = $_POST['imagen_actual'];
            }


            if (empty($tamaño) || empty($descripcion) || empty($precio)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }

            $this->model->updateRooms($tamaño, $descripcion, $imagen, $precio, $id);

            header('Location: ' . BASE_URL . 'showRooms');
        }
    }

    public function deleteRoom($id) {
        $this->model->deleteRooms($id);
        header('Location: ' . BASE_URL . 'showRooms');
    }

    public function getReserveByIdRoom($id){
        $roomSize=$this->model->getRoom($id);
        $roomId = $this->model->getReservesByRoomId($id);
        $this->view->showReservesByIdRoom($roomId,$roomSize);
    }
    
}