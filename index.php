<?php

use mvc\controller\controlador;
use mvc\model\modelo;
use config\dbconfig;
include_once './config/autoloader.php';

// Permitir solicitudes desde un origen específico
include_once './config/headers.php';

// Obtener el método HTTP y la URL solicitada
$metodoHTTP = $_SERVER['REQUEST_METHOD'];

// Tomar la segunda posicion de la URL $request[1]; se espera un ID
$personajeID = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$conexionDB = new dbconfig();
$modelo = new modelo(conexionDB:$conexionDB);
$controlador = new controlador(modeloIndex:$modelo);
$controlador->validarMetodo($metodoHTTP, $personajeID);
