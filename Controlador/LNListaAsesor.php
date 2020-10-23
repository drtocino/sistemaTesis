<?php
require_once("../Modelo/DBAsesor.php");
class LNListaAsesor{
    private $objDBAsesor;
		function __construct()
		{	
			$this->objDBAsesor = new DBAsesor();
        }
        public function listaAsesor(){
            $lista = $this->objDBAsesor->listaAsesor();
            return $lista;
        }
    }
?>