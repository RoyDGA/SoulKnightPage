<?php
namespace mvc\controller;

use mvc\model\modelo;

class controlador{

    public function __construct(public modelo $modelo) {
        $this->modelo = $modelo;
    }

    public function validarMetodo($metodo, $request, $personajes){
        switch ($metodo){
            case 'GET':
                $this->metodoGET($request, $personajes);
            break;

            case 'POST':
                $this->metodoPOST($personajes);
            break;

            case 'PUT':
                $this->metodoPUT($request, $personajes);
            break;

            case 'DELETE':
                $this->metodoDELETE($request, $personajes);
            break;
        }
    }

    public function metodoGET($request, $personajes){
        if(isset($request[1])){
            $id_personaje = intval($request[1]);
            foreach ($personajes as $personaje) {
                if ($personaje['id'] === $id_personaje) {
                    echo json_encode($personaje);
                    return;
                }
                echo json_encode(['No se encontraron personajes']);
            }
        }else{
            echo json_encode($personajes);
        }
    }

    public function metodoPOST($personajes){
        $datosBody = json_decode(file_get_contents('php://input'), true);

        $nuevoPersonaje = ['id'=> count($personajes), 'name'=> $datosBody['name'], 'email'=>$datosBody['email']];
        $personajes[] = $nuevoPersonaje;
        echo json_encode($personajes);
    }

    public function metodoPUT($request, $personajes){
        $datosBody = json_decode(file_get_contents('php://input'), true);

        if (isset($request[1])) {
            $id_personaje = intval($request[1]);

            foreach ($personajes as $personaje) {
                if ($personaje['id'] === $id_personaje) {
                    $personaje['name'] = $datosBody['name'];
                    $personaje['email'] = $datosBody['email'];
                }
            }
            echo json_encode($personajes);
        }
    }

    public function metodoDELETE($request, $personajes){
        if(isset($request[1])){
            $id_personaje = intval($request[1]);

            foreach ($personajes as $personaje) {
                if ($personaje['id'] === $id_personaje) {
                    unset($personajes[$id_personaje]);
                    break;
                }
            }
            echo json_encode($personajes);
        }
    }
}