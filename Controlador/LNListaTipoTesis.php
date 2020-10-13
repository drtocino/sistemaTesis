<?php
require_once("../Modelo/DBTipoTesis.php");
class LNListaTipoTesis{
    private $objDBTipoTesis;
		function __construct()
		{	
			$this->objDBTipoTesis = new DBTipoTesis();
        }
        public function listaTipoTesis(){
            $lista = $this->objDBTipoTesis->listaTipoTesis();
            return $lista;
        }
    }
?>