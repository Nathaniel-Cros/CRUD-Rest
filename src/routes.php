<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml');
});

/*
 * Rutas CRUD para Usuario
 * -----------------------
 */

//Ruta para obtener a usuarios
//------------------------------------
$app->get('/user/allusers', 'Src\Controllers\CrudController:getAll');
//Fin de Ruta para obtener a usuarios
//------------------------------------

//Ruta para obtener un usuario
//------------------------------------
$app->get('/user/{id}', 'Src\Controllers\CrudController:getUser');
//Fin de Ruta para obtener un usuario
//------------------------------------

//Ruta para agregar un usuario
//------------------------------------
$app->post('/user/New', 'Src\Controllers\CrudController:newUser');
//Fin de Ruta para agregar un usuario
//------------------------------------

//Ruta para actualizar un usuario
//------------------------------------
$app->put('/user/Update/{id}', 'Src\Controllers\CrudController:updateUser');
//Fin de Ruta para actualizar un usuario
//------------------------------------

//Ruta para borrar un usuario
//------------------------------------
$app->delete('/user/Delete/{id}', 'Src\Controllers\CrudController:deleteUser');
//Fin de Ruta para borrar un usuario
//------------------------------------

//Ruta para borrar un usuario
//------------------------------------
$app->post('/user/Login', 'Src\Controllers\CrudController:alogin');
//Fin de Ruta para borrar un usuario
//------------------------------------
/*
 * Fin de Rutas para Usuario
 * --------------------------
 */