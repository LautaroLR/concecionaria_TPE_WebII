<?php
class categoriaView{

public function listarCategorias($categorias){
    require_once 'templates/categoriasLista.phtml';
}

public function listarCategoria($vehiculos/*, $categoria_nombre*/){
    require_once 'templates/categoriaLista.phtml';
}
}