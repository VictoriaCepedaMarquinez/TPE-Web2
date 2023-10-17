<?php
require_once "./app/models/model.php";
class ReserveModel extends ModelDB {
    function getReserves() {
        $query = $this->db->prepare('SELECT r.*, h.precio * r.cant_noches AS total , h.tamaño
        FROM reserva r
        JOIN habitacion h ON(r.id_habitacion = h.id)
        ORDER BY r.id DESC');
        $query->execute();
        $reserves = $query->fetchAll(PDO::FETCH_OBJ);
        return $reserves;
    }
    
    function getRoomById($id){
        $query = $this->db->prepare("SELECT * FROM habitacion WHERE id=?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_OBJ);
    }
     
    function insertReserve( $id_usuario,$id_habitacion,$cant_noches) {
        $query = $this->db->prepare('INSERT INTO reserva ( id_usuario,id_habitacion,cant_noches) VALUES(?, ?, ?)');
        $query->execute([$id_usuario,$id_habitacion,$cant_noches]);
        return $this->getLastReserve();
    }

    function deleteReserve($id) {
        $query = $this->db->prepare('DELETE FROM reserva WHERE id = ?');
        $query->execute([$id]);
    }
   
    function modificReserve($id, $id_usuario, $id_habitacion, $cant_noches){
        $query = $this->db->prepare('UPDATE reserva SET id_usuario = ?, id_habitacion = ?, cant_noches = ?, finalizada = 0 WHERE id = ?');
        $query->execute([$id_usuario, $id_habitacion, $cant_noches, $id]);
    }

    function calculatePrice($reserva_id){
       $query = $this->db->prepare( 'SELECT reserva.cant_noches * habitacion.precio AS valor 
       FROM reserva 
       INNER JOIN habitacion ON reserva.id_habitacion = habitacion.id
       WHERE reserva.id = ?');
       $query->execute([$reserva_id]);
       $prices = $query->fetch(PDO::FETCH_OBJ);
        return $prices;
    }

    function getLastReserve(){
        $query = $this->db->prepare("SELECT r.*, h.tamaño as tamaño
        FROM reserva r
        JOIN habitacion h ON (r.id_habitacion = h.id)
        ORDER BY r.id DESC
        LIMIT 1");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    function getReserveAndRoomById($reserve_id){
        $query = $this->db->prepare( 'SELECT r.*, h.tamaño AS tamaño, h.precio AS precio
        FROM reserva r 
        JOIN habitacion h ON (r.id_habitacion = h.id)
        WHERE r.id = ?');
        $query->execute([$reserve_id]);
        $reserve = $query->fetch(PDO::FETCH_OBJ);
         return $reserve;
    }

    function getReserveById($id){
        $query = $this->db->prepare('SELECT r.* , h.tamaño AS tamaño
        FROM reserva r
        JOIN habitacion h ON (r.id_habitacion = h.id) 
        WHERE r.id = ?');
        $query->execute([$id]);
        $reserve = $query->fetcH(PDO::FETCH_OBJ);
        return $reserve;
    }

    function updateReserve($id){
       $query = $this->db->prepare('UPDATE reserva SET finalizada = 1 WHERE id = ?');
       $query->execute([$id]);
    }
}
