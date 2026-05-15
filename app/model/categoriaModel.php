<?php
require_once 'app/model/model.php';
class categoriaModel extends model{
    

    function connect(){
        $db=new PDO('mysql:host=MYSQL_HOST;'.'dbname=MYSQL_DB','MYSQL_USER','MYSQL_PASS');
        return $db;
    }

    public function getCategorias(){
        
        $query= $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVehiculosCategoria($id){
        $query=$this->db->prepare('SELECT * FROM vehiculos WHERE id_categoria=?');
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /*public function getNombre($id){
        $db=$this->connect();

        $query=$db->prepare('SELECT nombre FROM categorias where id_categoria=?');
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }*/

    public function guardarCategoria($nombre,$imagen,$descripcion){
    $query=$this->db->prepare("INSERT INTO categorias (nombre,imagen_url,descripcion) VALUES (?,?,?)");
    $query->execute([$nombre,$imagen,$descripcion]);
    }

    public function eliminarCategoria($id){
        $query=$this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id]);
    }

    public function getCategoria ($id){
    $query=$this->db->prepare('SELECT * FROM categorias WHERE id_categoria =?');
    $query->execute([$id]);

    return $query->fetch(PDO::FETCH_OBJ);
    }

    public function modificarCategoria($id,$nombre,$imagen,$descripcion){
    $query=$this->db->prepare('UPDATE categorias SET nombre = ?, descripcion = ?, imagen_url = ? WHERE id_categoria = ?');
    $query->execute([$nombre,$descripcion,$imagen,$id]);
    
    }
}