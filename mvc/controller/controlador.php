<?php
namespace mvc\controller;

use mvc\model\modelo;

class controlador{

    public $modelo;

    public function __construct(public modelo $modeloIndex) {
        $this->modelo = $modeloIndex;
    }

    public function validarMetodo($metodo, $request){
        switch ($metodo){
            case 'GET':
                $this->metodoGET($request);
            break;

            case 'POST':
                $this->metodoPOST();
            break;

            case 'PUT':
                $this->metodoPUT($request);
            break;

            case 'DELETE':
                $this->metodoDELETE($request);
            break;
        }
    }

    public function metodoGET($request){
        if(isset($request[1])){
            $personajeID = intval($request[1]);
            $this->modelo->buscarPersonaje($personajeID);

        }else{
            $this->modelo->Personajes();
        }
    }

    public function metodoPOST(){
        $datosBody = json_decode(file_get_contents('php://input'), true);
        $this->modelo->nuevoPersonaje($datosBody);
    }

    public function metodoPUT($request){
        $datosBody = json_decode(file_get_contents('php://input'), true);
        if (isset($request[1])) {
            $id_personaje = intval($request[1]);
            $this->modelo->editarPersonaje($id_personaje, $datosBody);
        }
    }

    public function metodoDELETE($request){
        if(isset($request[1])){
            $id_personaje = intval($request[1]);
            $this->modelo->eliminarPersonaje($id_personaje);            
        }
    }
}