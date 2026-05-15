<?php
class categoriaView
{

    public function listarCategorias($categorias)
    {
        require_once 'templates/categoriasLista.phtml';
    }

    public function listarCategoria($vehiculos/*, $categoria_nombre*/)
    {
        require_once 'templates/categoriaLista.phtml';
    }

    public function categoriaNueva(){
        require_once 'templates/formCrearCategoria.phtml';
    }

    public function editarCategoria($categoria){
        require_once 'templates/formEditarCategoria.phtml';
    }

}