<?php
require_once("../Modelo/DBCarrera.php");
class LNListaCarrera{
    private $objDBFacultad;
		function __construct()
		{	
			$this->objDBCarrera = new DBCarrera();
        }
    public function tesisCarrera($facultad){
        $lista = $this->objDBCarrera->tesisCarrera($facultad);
		return $lista;
    }
}
?>