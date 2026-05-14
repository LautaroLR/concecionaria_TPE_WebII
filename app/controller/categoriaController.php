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
        $vehiculos=$this->model->getCategoria($id);
       //$categoria=$this->model->getNombre($id);

        $this->view->listarCategoria($vehiculos/*, $categoria*/);
    }
}