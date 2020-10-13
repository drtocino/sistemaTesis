<?php
require_once("../Modelo/DBFacultad.php");
class LNListaFacultad{
    private $objDBFacultad;
	function __construct(){	
		$this->objDBFacultad = new DBFacultad();
    }
    /*public function listaFacultad(){
        $lista = $this->objDBFacultad->listaFacultad();
		return $lista;
    }*/
    public function reporteFacultad(){
        $lista = $this->objDBFacultad->reporteFacultad();
		return $lista;
    }
    public function reporteAnualFacultad($facultad){
        $lista = $this->objDBFacultad->reporteAnualFacultad($facultad);
		return $lista;
    }
    public function reporteFacultadFecha($fechaInicio,$fechaFin){
        $lista = $this->objDBFacultad->reporteFacultadFecha($fechaInicio,$fechaFin);
		return $lista;
    }
}
?>