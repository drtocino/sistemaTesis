<?php
require_once("../Modelo/DBFacultad.php");
class LNListaFacultad{
    private $objDBFacultad;
		function __construct()
		{	
			$this->objDBFacultad = new DBFacultad();
        }
    public function reporteFacultad(){
        $lista = $this->objDBFacultad->reporteFacultad();
		return $lista;
    }
}
?>