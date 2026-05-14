<?php
    
    require_once 'app/controller/categoriaController.php';

    // En tu archivo de configuración o al principio del router define la base
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    if(!empty($_GET['action'])){
        $action = $_GET['action'];
        }
        else{
            $action = 'home';
        }

    $params= explode('/',$action);

    switch ($params[0]) {
    case 'home':
        echo 'home';
        break;
    case 'listarVehiculos':
        echo 'listar vehiculos';
    break;

    case'listarCategorias':
        $controller=new categoriaController();
        $controller->listarCategorias();
        break;

    case 'categoria':
        $controller=new categoriaController();
        $controller->listarCategoria($params[1]);
        break;    

    }