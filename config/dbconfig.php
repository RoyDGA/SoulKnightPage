<?php

namespace config;

use Exception;
use PDO;

class dbconfig{

    private $HOSTNAME = 'localhost';
    private $DBNAME = 'createapi';
    private $USERNAME = 'root';
    private $PASSWORD = '';

    public function conexion(){
        try {
            $conexion = new PDO("mysql:host=$this->HOSTNAME;dbname=$this->DBNAME", $this->USERNAME, $this->PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;

        } catch (\PDOException $e) {
            throw new Exception("ERROR AL CONECTAR: ".$e->getMessage());
            
        }
    }
}