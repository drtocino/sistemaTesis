<?php
require_once("../Modelo/DBTesis.php");
class LNListaTesis{
    private $objDBTesis;
		function __construct()
		{	
			$this->objDBTesis = new DBTesis();
        }
    public function listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio){
        $lista = $this->objDBTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio);
		return $lista;
    }
    public function listaTesisCarrera($busqueda,$idCarrera,$idTipoTesis){
        $lista = $this->objDBTesis->listaTesisCarrera($busqueda,$idCarrera,$idTipoTesis);
		return $lista;
    }
    public function detalleTesis($idTesis){
        $lista = $this->objDBTesis->detalleTesis($idTesis);
		return $lista;
    }
    
}
?>