<?php
require_once 'app/model/categoriaModel.php';
require_once 'app/view/categoriaView.php';



class categoriaController{
    private $model;
    private $view;

    public function __construct(){
        $this->model=new categoriaModel();
        $this->view=new categoriaView();

    }

    public function listarCategorias(){
        $categorias=$this->model->getCategorias();

        $this->view->listarCategorias($categorias);
    }

    public function listarCategoria($id){
        $vehiculos=$this->model->getVehiculosCategoria($id);
       //$categoria=$this->model->getNombre($id);

        $this->view->listarCategoria($vehiculos/*, $categoria*/);
    }
    
    public function categoriaNueva(){
        $this->view->categoriaNueva();
    }

    public function guardarCategoria(){

    if(!isset($_POST['nombre']) || !isset($_POST['imagen']) || !isset($_POST['descripcion'])){
        echo "Faltan datos obligatorios";
            return;
    }

    $nombre=$_POST['nombre'];
    $imagen=$_POST['imagen'];
    $descripcion=$_POST['descripcion'];

    $this->model->guardarCategoria($nombre,$imagen,$descripcion);

    header("Location: " . BASE_URL . "listarCategorias");
    }

    public function eliminarCategoria($id){
    $this->model->eliminarCategoria($id);

    header("Location: " . BASE_URL . "listarCategorias");

    }

    public function editarCategoria($id){
    $categoria=$this->model->getCategoria($id);
    $this->view->editarCategoria($categoria);
    }

    public function modificarCategoria($id){
        if(!isset($_POST['nombre']) || !isset($_POST['imagen']) || !isset($_POST['descripcion'])){
            echo "Faltan datos obligatorios";
            return;
        }

        $nombre=$_POST['nombre'];
        $imagen=$_POST['imagen'];
        $descripcion=$_POST['descripcion'];

    $this->model->modificarCategoria($id,$nombre,$imagen,$descripcion);
    
    header("Location: " . BASE_URL . "listarCategorias");
    }
}