<?php
require_once("../Modelo/DBTesis.php");
class LNListaTesis{
    private $objDBTesis;
		function __construct()
		{	
			$this->objDBTesis = new DBTesis();
        }
    public function listaTesis($busqueda){
        $lista = $this->objDBTesis->listaTesis($busqueda);
		return $lista;
    }
    public function detalleTesis($idTesis){
        $lista = $this->objDBTesis->detalleTesis($idTesis);
		return $lista;
    }
    
}
?>