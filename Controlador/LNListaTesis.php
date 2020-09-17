<?php
require_once("../Modelo/DBUsuario.php");
class LNListaTesis{
    private $objDBUsuario;
		function __construct()
		{	
			$this->objDBUsuario = new DBUsuario();
        }
    public function listaTesis($busqueda){
        $lista = $this->objDBUsuario->listaTesis($busqueda);
		return $lista;
    }
}
?>