<?php 

class DataBaseHelper{
   
    public static function createDBIfNotExists($host, $userName, $password, $dataBaseName){
        $pdo = new PDO("mysql:host=$host", $userName, $password);
        $query = "CREATE DATABASE IF NOT EXISTS hotel";
        $pdo->exec($query);
    }
}