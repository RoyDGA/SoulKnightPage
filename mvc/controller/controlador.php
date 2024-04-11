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
        if (isset($_POST['nombre'],$_POST['daño'],$_POST['vida'],$_POST['escudo'],$_POST['energia'],$_POST['precio'],$_FILES['imagen']['tmp_name']) &&
        !empty(trim($_POST['nombre'])) && !empty(trim($_POST['vida'])) && !empty(trim($_POST['escudo'])) && !empty(trim($_POST['energia'])) && !empty(trim($_POST['precio'])) && !empty($_FILES['imagen']['tmp_name'])) {
            
            $nombre = $_POST['nombre'];
            $daño = $_POST['daño'];
            $vida = $_POST['vida'];
            $escudo = $_POST['escudo'];
            $energia = $_POST['energia'];
            $precio = $_POST['precio'];
            $imagen = $_FILES['imagen'];
            
            $datosPersonaje = [
                "nombre" => htmlspecialchars($nombre),
                "daño" => filter_var($daño, FILTER_SANITIZE_SPECIAL_CHARS),
                "vida" => filter_var($vida, FILTER_VALIDATE_INT),
                "escudo" => filter_var($escudo, FILTER_VALIDATE_INT),
                "energia" => filter_var($energia, FILTER_VALIDATE_INT),
                "precio" => filter_var($precio, FILTER_VALIDATE_INT),
                "imagen" => $imagen,
                "fecha" => date("Y-m-d")
            ];
            $this->validarImagen($imagen);
            $this->modelo->nuevoPersonaje($datosPersonaje);
        }
        else{
            echo json_encode(["mensaje" => "ALGUNOS DATOS NO FUERON ENVIADOS"]);
        }
    }

    public function validarImagen($imagen){
        $nameImg = $imagen['name'];
        $tmpImg = $imagen['tmp_name'];
        $tipoImg = $imagen['type'];
        $pesoImg = $imagen['size'];
        
        $dir = "../ApiEjemplo/assets/";
        $crearRuta = $dir . $nameImg;

        $tipoPermitido = ["image/jpeg", "image/png", "image/jpg", "image/gif", "image/webp"];
        if (in_array($tipoImg, $tipoPermitido)) {
            move_uploaded_file($tmpImg, $crearRuta);
            return [$nameImg, $pesoImg, $tmpImg, $tipoImg];
        }
        else{
            echo json_encode(["mensaje" => "EL TIPO DE IMAGEN NO ES PERMITIDO"]);
        }
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