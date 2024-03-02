<?php

use mvc\controller\controlador;
use mvc\model\modelo;
use config\dbconfig;
include_once './config/autoloader.php';

// Permitir solicitudes desde un origen específico
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Obtener el método HTTP y la URL solicitada
$method = $_SERVER['REQUEST_METHOD'];
// Nombre del archivo
$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
// Tomar la segunda posicion de la URL $request[1]; se espera un ID


$conexionDB = new dbconfig();

$modelo = new modelo(conexionDB:$conexionDB);

$controlador = new controlador(modeloIndex:$modelo);
$controlador->validarMetodo($method, $request, $personajes = 'hola');









































// Manejar las solicitudes
// switch ($method) {


//     // Traer un usuario
//     case 'GET':
//         // Si existe un segundo parametro ID
//         if(isset($request[1])) {
//             // Valor entero
//             $user_id = intval($request[1]);
//             // Para cada $user dentro del array $users
//             foreach ($users as $user) {
//                 // Si $user_id es igual al del $user actual
//                 if ($user['id'] === $user_id) {
//                     // Retorna JSON con el usuario
//                     echo json_encode($user);
//                     return;
//                 }
//             }
//             // Si no existe, retorna un array vacío
//             echo json_encode(array());
//         } else {
//             // Si no hay ID sigue mostrando todos
//             echo json_encode($users);
//         }
//     break;

//     // Añadir usuario
//     case 'POST':
//         // Recibe el JSON con los datos enviados en el Body de fetch
//         $data = json_decode(file_get_contents('php://input'), true);
//         // Crear usuario con los datos que contiene $data ('name', 'email')
//         $new_user = ['id' => count($users) + 1, 'name' => $data['name'], 'email' => $data['email']];
//         // Añadir al array de $Users
//         $users[] = $new_user;
//         // Mostrar el nuevo array $Users
//         echo json_encode(['DatosEnviadosBody'=>$data]);
//     break;

//     // Actualizar usuario
//     case 'PUT':
//         // Volver a numero entero
//         $user_id = intval($request[1]);
//         // Recibe el JSON con los datos enviados en el Body de fetch
//         $data = json_decode(file_get_contents('php://input'), true);
//         // Buscar por ID al usuario a modificar
//         foreach ($users as &$user) {
//             // Si $user_id es igual al del $user actual
//             if ($user['id'] === $user_id) {
//                 // Remplazar valores de $user por los de $data
//                 $user['name'] = $data['name'];
//                 $user['email'] = $data['email'];
//                 break;
//             }
//         }
//         // Mostrar el nuevo array $Users
//         echo json_encode($users);
//     break;

//     // Eliminar usuario
//     case 'DELETE':
//         // Volver numero entero
//         $user_id = intval($request[1]);
//         // Buscar al $user en el array de $users
//         foreach ($users as $user => $value) {
//             // Si el $user_id es igual al del $user actual
//             if ($user['id'] === $user_id) {
//                 // Borrar usuario
//                 unset($users[$user]);
//                 break;
//             }
//         }
//         // Mostrar el nuevo array $Users
//         echo json_encode($users);
//     break;
// }




