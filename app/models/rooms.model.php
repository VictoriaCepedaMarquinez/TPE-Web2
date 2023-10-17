<?php
require_once "./app/models/model.php";
class RoomsModel extends ModelDB {
   
    function getRooms() {
        $query = $this->db->prepare('SELECT * FROM habitacion');
        $query->execute();
        $rooms = $query->fetchAll(PDO::FETCH_OBJ);
        return $rooms;
    }
    
    function insertRooms($tamaño,$descripcion,$imagen,$precio){
        $query = $this->db->prepare('INSERT INTO habitacion (tamaño, descripcion, imagen, precio) VALUES(?,?,?,?)');
        $query->execute([$tamaño,$descripcion,$imagen,$precio]);
    }

    function getReservesByRoomId($room_id){
        $query = $this->db->prepare( 'SELECT r.*, h.tamaño AS tamaño, h.precio AS precio
        FROM habitacion h 
        JOIN reserva r ON (h.id = r.id_habitacion)
        WHERE h.id = ?');
        $query->execute([$room_id]);
        $reserves = $query->fetchAll(PDO::FETCH_OBJ);
        return $reserves;
    }
    
    public function updateRooms($tamaño, $descripcion, $imagen, $precio, $id) {
        $query = $this->db->prepare("UPDATE habitacion SET tamaño=?, descripcion=?, imagen=?, precio=? WHERE id=?");
        $query->execute([$tamaño, $descripcion, $imagen, $precio, $id]);
    }

    public function deleteRooms($id){
        $query = $this->db->prepare("DELETE FROM habitacion WHERE id = ? ");
        $query->execute([$id]);
    }

    public function getRoom($room_id){
        $query=$this->db->prepare('SELECT h.tamaño FROM habitacion h WHERE h.id=?');
        $query->execute([$room_id]);
        $tamaño=$query->fetch(PDO::FETCH_OBJ);
        return $tamaño;

    }

}
