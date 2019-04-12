<?php

namespace Src\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use \PDO;
use Firebase\JWT\JWT;
require 'db.php';

define("key_secret","qwq9Uag3FT");

class CrudController
{
    /*
     * Esta funcion regresa todos los usuarios de la base de datos
     */
    public function getAll(Request $request,Response $response){
        $sql = "SELECT * FROM usuarios";
        try{
            $db = new db();
            $db = $db->connectionDB();
            $resultado = $db->query($sql);
            if( $resultado->rowCount() > 0){
                $usuarios = $resultado->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($usuarios);
            }else{
                echo json_encode(array(['error' => 'No existen Usuarios']));
            }
            $db = null;
            $result = null;
        }catch(PDOException $e){
            echo '{"error" : { "text": "'.$e->getMessage().'"}';
        }
    }

    /*
     * Esta funcion regresa un solo usuario de la base de datos
     */
    public function getUser(Request $request,Response $response)
    {
        $id = $request->getAttribute('id');
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        try {
            $db = new db();
            $db = $db->connectionDB();
            $resultado = $db->query($sql);
            if ($resultado->rowCount() > 0) {
                $usuario = $resultado->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($usuario);
            } else {
                echo json_encode(array(['error' => 'No existe Usuario']));
            }
            $db = null;
            $result = null;
        } catch (PDOException $e) {
            echo '{"error" : { "text": "' . $e->getMessage() . '"}';
        }
    }

    /*
     * Esta funcion agrega un nuevo usuaio a la base de datos
     */
    public function newUser(Request $request, Response $response){

        $nombre = $request->getParam('nombre');
        $telefono = (string)$request->getParam('telefono');
        $direccion = $request->getParam('direccion');
        $email = $request->getParam('email');
        $username = $request->getParam('username');
        $pass = $request->getParam('pass');

        $sql = "INSERT INTO usuarios (nombre, telefono, direccion, email, username, pass) VALUES
            (:nombre, :telefono, :direccion, :email, :username, :pass)";

        try{

            $db = new db();
            $db = $db->connectionDB();

            $resultado = $db->prepare($sql);

            if($resultado->execute(array(
                'nombre' => $nombre,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'email' => $email,
                'username' => $username,
                'pass' => md5($pass),
            )))
                echo json_encode(array('mensaje' => 'Usuario agregado'));
            else
                echo json_encode(array('mensaje:'=> 'Error al agregar usuario'));

            $resultado->closeCursor();
            $resultado = null;
            $db = null;


        }catch(PDOException $e){
            echo '{"error" : { "text": "'.$e->getMessage().'","sql": "'.$sql.'"}';
        }
    }

    /*
     * Esta funcion hace una actualizacion de un usuario en la base de datos
     */
    public function updateUser(Request $request, Response $response){

        $id = $request->getAttribute('id');

        $nombre = $request->getParam('nombre');
        $telefono = $request->getParam('telefono');
        $direccion = $request->getParam('direccion');
        $email = $request->getParam('email');
        $username = $request->getParam('username');
        $pass = $request->getParam('pass');

        $sql = "UPDATE usuarios SET 
              nombre = :nombre,
              telefono = :telefono,
              direccion = :direccion,
              email = :email,
              username = :username,
              pass = :pass
              WHERE  id = $id";

        try{
            $db = new db();
            $db = $db->connectionDB();
            $result = $db->prepare($sql);

            $result->bindParam(':nombre', $nombre);
            $result->bindParam(':telefono', $telefono);
            $result->bindParam(':direccion', $direccion);
            $result->bindParam(':email', $email);
            $result->bindParam(':username', $username);
            $result->bindParam(':pass', md5($pass));

            if($result->execute())
                echo json_encode(array(['mensaje' => 'Usuario con id '.$id.': Modificado Correctamente!']));
            else
                echo json_encode(array(['mensaje' => 'Error usuario con id '.$id.': No modificado!']));

            $result->closeCursor();
            $db = null;
            $result = null;

        }catch(PDOException $e){
            echo '{"error" : { "text": "'.$e->getMessage().'"}';
        }

    }

    /*
     * Esta funcion Borra un usuario de la bade de datos
     */
    public function deleteUser(Request $request, Response $response){
        $id = $request->getAttribute('id');

        $sql = "DELETE FROM usuarios WHERE id = :id";
        try{
            $db = new db();
            $db = $db->connectionDB();
            $result = $db->prepare($sql);
            $result->execute(array(
                "id"=>$id
            ));
            if( $result->rowCount() > 0 ){
                echo json_encode(array(['mensaje' => 'Usuario con id '.$id.': Borrado Correctamente!']));
            }else{
                echo json_encode(array(['mensaje' => 'Usuario con id '.$id.': No Borrado!']));
            }
            $result->closeCursor();
            $db = null;
            $result = null;

        }catch(PDOException $e){
            echo '{"error" : { "text": "'.$e->getMessage().'"}';
        }

    }

    /*
     * Esta funcion regresa un token comprobando que los datos sean correctos
     */
    public function alogin(Request $request, Response $response)
    {
        $email = $request->getParam('email');
        $pass = md5($request->getParam('pass'));

        $sql = "SELECT * FROM usuarios WHERE (email = \"".$email."\" AND pass = \"".$pass."\") OR ( username = \"".$email."\" AND pass = \"".$pass."\")";

        try{

            $db = new db();
            $db = $db->connectionDB();
            $result = $db->query($sql);

            if( $result->rowCount() > 0 ){
                $usuario = $result->fetchAll(PDO::FETCH_OBJ);
                $time = time();
                $token = array(
                    'iat' => $time,
                    'exp' => $time + (24*60*60),//(horas,segundos,milisegundos)
                    'user' => $usuario[0]
                );

                $jwt = JWT::encode($token, key_secret ,'HS512');

                $token = array(
                    'token'=> $jwt,
                    'iat' => $time,
                    'exp' => $time + (24*60*60),//(horas,segundos,milisegundos)
                    'user' => $usuario[0]
                );

                echo json_encode($token);
            }else{
                echo json_encode(array(['mensaje'=>'Rectifica tus datos']));
            }
            //$db->closeCursor();
            $db = null;
            $result = null;

        }catch(PDOException $e){
            echo '{"error" : { "sql": "'.$sql.'","text": "'.$e->getMessage().'"}';
        }
    }
}