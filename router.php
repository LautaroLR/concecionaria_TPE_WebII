<?php
    
    if(!empty($_GET['action'])){
        $action = $_GET['action'];
        }
        else{
            $action = 'home';
        }

    $params= explode('/',$action);

    switch ($params[0]) {
    case 'home':
        require_once "templates/layout/header.phtml";
        require_once "templates/layout/footer.phtml";

    }