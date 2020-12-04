<?php
require_once("../Modelo/DBParticipante.php");
class LNListaParticipante{
    private $objDBParticipante;
		function __construct(){	
			$this->objDBParticipante = new DBParticipante();
        }
    public function listaParticipante(){
        $lista = $this->objDBParticipante->listaParticipante();
		return $lista;
    }
    public function datosParticipante($idParticipante){
        $lista = $this->objDBParticipante->datosParticipante($idParticipante);
		return $lista;
    }
}
?>