<?php
require_once("../Modelo/DBUsuario.php");
class LNListaUsuario{
    private $objDBUsuario;
		function __construct(){	
			$this->objDBUsuario = new DBUsuario();
        }

    public function listaUsuario(){
        $lista = $this->objDBUsuario->listaUsuario();
		return $lista;
    }
}
?>