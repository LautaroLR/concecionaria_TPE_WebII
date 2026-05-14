<?php

class categoriaModel{
    private $db;

    function connect(){
        $db=new PDO('mysql:host=localhost;'.'dbname=concesionaria_web2','root','');
        return $db;
    }

    public function getCategorias(){
        $db= $this->connect();

        $query= $db->prepare('SELECT * FROM categorias');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoria($id){
        $db=$this->connect();

        $query=$db->prepare('SELECT * FROM vehiculos WHERE id_categoria=?');
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /*public function getNombre($id){
        $db=$this->connect();

        $query=$db->prepare('SELECT nombre FROM categorias where id_categoria=?');
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }*/
}