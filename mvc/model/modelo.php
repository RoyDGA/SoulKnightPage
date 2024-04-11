<?php 
namespace mvc\model;

use PDO;
use PDOException;
use Exception;



class modelo {

    private $conDB;

    public function __construct(public $conexionDB) {
        $this->conDB = $conexionDB->conexion();
    }

    public function Personajes(){

        try {

            $consulta = "SELECT * FROM personajes";
            $stmt = $this->conDB->prepare($consulta);

            $stmt->execute();
            $tablaPersonajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($tablaPersonajes) {
                echo json_encode(['personajes' => $tablaPersonajes]);
            }
            
        } catch (PDOException $e) {
            throw new Exception("ERROR EN LA CONSULTA: ".$e->getMessage());
        }
    }
    
    public function buscarPersonaje($personajeID){
        try {
            $consulta = "SELECT * FROM personajes WHERE id_personaje = ?";
            $stmt = $this->conDB->prepare($consulta);
    
            $stmt->bindParam(1, $personajeID, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($resultado);

        } catch (PDOException $e) {
            throw new Exception("ERROR EN LA CONSULTA: ".$e->getMessage());
            
        }
        
    }

    public function nuevoPersonaje($datosPersonaje){
        try {
            $consulta = "INSERT INTO personajes (nombre_personaje, daño_personaje, vida_personaje, escudo_personaje, energia_personaje, precio_personaje, fecha_personaje) VALUES (?,?,?,?,?,?,?)";
            
            // $personaje = [
            //     "nombre" => $datosBody['nombre_personaje'],
            //     "daño" => $datosBody['daño_personaje'],
            //     "vida" => $datosBody['vida_personaje'],
            //     "escudo" => $datosBody['escudo_personaje'],
            //     "energia" => $datosBody['energia_personaje'],
            //     "precio" => $datosBody['precio_personaje'],
            //     "fecha" => date("Y-m-d")
            // ];
            // $arrayPersonaje = (object)$personaje;

            $stmt = $this->conDB->prepare($consulta);
            
            
            $stmt->bindParam(1, $datosPersonaje["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(2, $datosPersonaje["daño"], PDO::PARAM_INT);
            $stmt->bindParam(3, $datosPersonaje["vida"], PDO::PARAM_INT);
            $stmt->bindParam(4, $datosPersonaje["escudo"], PDO::PARAM_INT);
            $stmt->bindParam(5, $datosPersonaje["energia"], PDO::PARAM_INT);
            $stmt->bindParam(6, $datosPersonaje["precio"], PDO::PARAM_INT);
            $stmt->bindParam(7, $datosPersonaje["fecha"], PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(["DATOS" => $datosPersonaje,
            "IMAGEN" => [
                $datosPersonaje["imagen"]["name"],
                $datosPersonaje["imagen"]["tmp_name"],
                $datosPersonaje["imagen"]["type"],
                $datosPersonaje["imagen"]["size"]
                ]
            ]);
        } catch (PDOException $e) {
            throw new Exception("ERROR EN LA CONSULTA: ".$e->getMessage());
        }
    }


    public function editarPersonaje($request, $datosBody){
        try {
            $consulta = "UPDATE personajes SET nombre_personaje = ?, daño_personaje = ?, vida_personaje = ?, escudo_personaje = ?, energia_personaje = ?, precio_personaje = ? WHERE id_personaje = ?";
            $stmt = $this->conDB->prepare($consulta);
    
            $nombre_personaje = $datosBody['nombre_personaje'];
            $daño_personaje = $datosBody['daño_personaje'];
            $vida_personaje = $datosBody['vida_personaje'];
            $escudo_personaje = $datosBody['escudo_personaje'];
            $energia_personaje = $datosBody['energia_personaje'];
            $precio_personaje = $datosBody['precio_personaje'];
    
            $stmt->bindParam(1, $nombre_personaje, PDO::PARAM_STR);
            $stmt->bindParam(2, $daño_personaje, PDO::PARAM_INT);
            $stmt->bindParam(3, $vida_personaje, PDO::PARAM_INT);
            $stmt->bindParam(4, $escudo_personaje, PDO::PARAM_INT);
            $stmt->bindParam(5, $energia_personaje, PDO::PARAM_INT);
            $stmt->bindParam(6, $precio_personaje, PDO::PARAM_INT);
            $stmt->bindParam(7, $request, PDO::PARAM_INT);
            $stmt->execute();

            $this->Personajes();
            
        } catch (PDOException $e) {
            throw new Exception("ERROR EN LA CONSULTA".$e->getMessage());
            
        }
    }

    public function eliminarPersonaje($request){
        try{
            $consulta = "DELETE FROM personajes WHERE id_personaje = ?";
            $stmt = $this->conDB->prepare($consulta);
            
            $stmt->bindParam(1, $request, PDO::PARAM_INT);
            $stmt->execute();
            
            $this->Personajes();
        } catch (PDOException $e) {
            throw new Exception("ERROR EN LA CONSULTA".$e->getMessage());
            
        }
    } 
}